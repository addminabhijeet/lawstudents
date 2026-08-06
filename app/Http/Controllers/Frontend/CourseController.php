<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;


class CourseController extends Controller
{
    public function __invoke(): View
    {
        $categories = Category::whereHas('courses.notes', function ($query) {
            $query->where('status', 1);
        })
            ->with([
                'courses' => function ($query) {
                    $query
                        ->whereHas('notes', function ($q) {
                            $q->where('status', 1);
                        })
                        ->with(['notes' => function ($q) {
                            $q->where('status', 1);
                        }]);
                },
                'children' => function ($query) {
                    $query->whereHas('courses.notes', function ($q) {
                        $q->where('status', 1);
                    })
                        ->with([
                            'courses' => function ($q) {
                                $q
                                    ->whereHas('notes', function ($n) {
                                        $n->where('status', 1);
                                    })
                                    ->with(['notes' => function ($n) {
                                        $n->where('status', 1);
                                    }]);
                            }
                        ]);
                }
            ])
            ->get();

        // Paginated courses for display (12 per page)
        $allCourses = Course::where('status', 1)
            ->whereHas('notes', function ($query) {
                $query->where('status', 1);
            })
            ->with(['notes', 'category'])
            ->paginate(12);

        return view('course.course', compact('categories', 'allCourses'));
    }

    public function coursesearch(Request $request)
    {
        $query = $request->get('q');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $courses = Course::with(['category', 'notes'])
            ->where('status', 1)
            ->where(function ($q) use ($query) {

                // Search by course title
                $q->where('title', 'LIKE', "%{$query}%")

                    // Search in category name
                    ->orWhereHas('category', function ($q2) use ($query) {
                        $q2->where('name', 'LIKE', "%{$query}%");
                    })

                    // Search in notes (if notes have title/description)
                    ->orWhereHas('notes', function ($q3) use ($query) {
                        $q3->where('status', 1)
                            ->where('title', 'LIKE', "%{$query}%");
                    });
            })
            ->limit(15)
            ->get()
            ->map(function ($course) {

                // pick first note (if exists)
                $note = $course->notes->first();

                return [
                    'title' => $course->title,
                    'category_name' => $course->category->name ?? 'Uncategorized',
                    'course_id' => $course->id,
                    'category_id' => $course->category_id ?? null,
                    'note_id' => $note->id ?? null,
                ];
            });

        return response()->json($courses);
    }
}
