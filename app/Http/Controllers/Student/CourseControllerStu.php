<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseNote;
use App\Models\StudentActivity;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Models\NoteWishlist;
use App\Models\NoteProgress;
use Illuminate\Support\Facades\Log;

class CourseControllerStu extends Controller
{

    public function listcourse()
    {
        $student = Auth::guard('student')->user();

        $payments = Payment::where('student_id', $student->id)
            ->where('payment_status', 'paid')
            ->whereMonth('issue_date', Carbon::now()->month)
            ->whereYear('issue_date', Carbon::now()->year)
            ->pluck('course_id');

        // Flatten course IDs
        $paidCourseIds = [];
        foreach ($payments as $courseIdsString) {
            if ($courseIdsString) {
                $ids = explode(',', $courseIdsString);
                $paidCourseIds = array_merge($paidCourseIds, $ids);
            }
        }

        $paidCourseIds = array_map('intval', $paidCourseIds);
        $paidCourseIds = array_unique($paidCourseIds);

        // Get categories with paid courses
        $categories = Category::whereHas('courses', function ($query) use ($paidCourseIds) {
            $query->whereIn('id', $paidCourseIds);
        })
            ->with(['courses' => function ($query) use ($paidCourseIds) {
                $query->whereIn('id', $paidCourseIds);
            }])
            ->get();

        $notFound = false;
        if (empty($paidCourseIds) || $categories->isEmpty()) {
            $notFound = true;
        }

        return view('coursestu.list', compact('categories', 'notFound'));
    }

    public function viewcourse($id)
    {
        $student = Auth::guard('student')->user();

        // Check if the student has a payment containing this course
        $payment = Payment::where('student_id', $student->id)
            ->where('payment_status', 'paid')
            ->whereRaw("FIND_IN_SET(?, course_id)", [$id])
            ->first();

        if (!$payment) {
            abort(403, 'You have not purchased this course.');
        }

        $course = Course::with([
            'category',
            'notes' => function ($query) {
                $query->where('status', 1);
            }
        ])->findOrFail($id);

        StudentActivity::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'activity_type' => 'view_course'
        ]);

        return view('coursestu.view', compact('course'));
    }


    public function viewNote(Request $request, $id)
    {
        if (!$request->has('token')) {
            abort(403, 'Direct access blocked.');
        }

        if (!Auth::guard('student')->check()) {
            abort(403, 'Unauthorized');
        }

        try {

            $data = json_decode(Crypt::decrypt($request->token), true);
        } catch (\Exception $e) {

            abort(403, 'Invalid token.');
        }

        if ($data['note_id'] != $id) {
            abort(403);
        }

        if ($data['ip'] != $request->ip()) {
            abort(403, 'Invalid viewer location.');
        }

        if (Carbon::parse($data['expires_at'])->isPast()) {
            abort(403, 'Viewer link expired.');
        }

        $student = Auth::guard('student')->user();

        $note = CourseNote::findOrFail($id);

        $payment = Payment::where('student_id', $student->id)
            ->where('course_id', $note->course_id)
            ->where('payment_status', 'paid')
            ->first();

        if (!$payment) {
            abort(403, 'You do not have access to this note.');
        }

        $filePath = storage_path('app/public/' . $note->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        StudentActivity::create([
            'student_id' => $student->id,
            'course_id' => $note->course_id,
            'note_id' => $note->id,
            'activity_type' => 'view_note'
        ]);

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="viewer.pdf"',
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
            'X-Frame-Options' => 'DENY',
        ]);
    }

    public function wishlist(Request $request)
    {
        $studentId = Auth::guard('student')->id();

        if (!$request->has('note_id')) {
            return response()->json(['status' => 'error', 'message' => 'Note ID missing'], 400);
        }

        $noteId = $request->note_id;

        try {
            $exists = NoteWishlist::where('student_id', $studentId)
                ->where('note_id', $noteId)
                ->first();

            if ($exists) {
                $exists->delete();
                return response()->json([
                    'status' => 'removed',
                    'student_id' => $studentId
                ]);
            }

            NoteWishlist::create([
                'student_id' => $studentId,
                'note_id' => $noteId
            ]);

            return response()->json([
                'status' => 'added',
                'student_id' => $studentId
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'student_id' => $studentId
            ], 500);
        }
    }

    public function saveProgress(Request $request)
    {
        $student = Auth::guard('student')->user();

        $note = CourseNote::findOrFail($request->note_id);

        $progress = NoteProgress::firstOrCreate([
            'student_id' => $student->id,
            'note_id' => $note->id
        ], [
            'course_id' => $note->course_id,
            'total_pages' => $request->total_pages
        ]);

        $progress->viewed_pages = max($progress->viewed_pages, $request->page);

        $progress->progress_percent =
            ($progress->viewed_pages / $progress->total_pages) * 100;

        $progress->save();

        return response()->json(['status' => 'ok']);
    }


    public function downloadNote($id)
    {
        $student = Auth::guard('student')->user();

        $note = CourseNote::with('course')->findOrFail($id);

        $payment = Payment::where('student_id', $student->id)
            ->where('course_id', $note->course_id)
            ->where('payment_status', 'paid')
            ->first();

        if (!$payment) {
            abort(403, 'You do not have access to this note.');
        }

        if (!$note->is_downloadable) {
            abort(403, 'Download not allowed.');
        }

        $note->increment('download_count');

        $filePath = storage_path('app/public/' . $note->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        StudentActivity::create([
            'student_id' => $student->id,
            'course_id' => $note->course_id,
            'note_id' => $note->id,
            'activity_type' => 'download_note'
        ]);

        return response()->download($filePath, $note->title . '.pdf');
    }
}
