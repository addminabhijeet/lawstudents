<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Course;
use App\Models\Category;
use App\Models\Act;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActsController extends Controller
{
    public function __invoke(): View
    {
        $categories = Category::whereHas('courses.notes', function ($query) {
            $query->where('visibility', 'free')
                ->where('status', 1);
        })
            ->with([
                'courses' => function ($query) {
                    $query->where('is_free', 1)
                        ->whereHas('notes', function ($q) {
                            $q->where('visibility', 'free')
                                ->where('status', 1);
                        })
                        ->with(['notes' => function ($q) {
                            $q->where('visibility', 'free')
                                ->where('status', 1);
                        }])
                        ->orderBy('created_at', 'desc')
                        ->paginate(6);
                },
                'children' => function ($query) {
                    $query->whereHas('courses.notes', function ($q) {
                        $q->where('visibility', 'free')
                            ->where('status', 1);
                    })
                        ->with([
                            'courses' => function ($q) {
                                $q->where('is_free', 1)
                                    ->whereHas('notes', function ($n) {
                                        $n->where('visibility', 'free')
                                            ->where('status', 1);
                                    })
                                    ->with(['notes' => function ($n) {
                                        $n->where('visibility', 'free')
                                            ->where('status', 1);
                                    }])
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(6);
                            }
                        ]);
                }
            ])
            ->get();

        $courses = Course::where('status', 1)
            ->where('is_free', 1)
            ->whereHas('notes', function ($query) {
                $query->where('visibility', 'free')
                    ->where('status', 1);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('acts.acts', compact('categories', 'courses'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (strlen($query) < 3) {
            return response()->json([]);
        }

        $notes = Act::where('visibility', 'free')
            ->where('status', 1)
            ->where('title', 'LIKE', "%{$query}%")
            ->with('course')
            ->limit(10)
            ->get()
            ->map(function ($note) {
                return [
                    'title' => $note->title,
                    'type' => 'Act',
                    'note_id' => $note->id,
                    'course_id' => $note->course_id,
                    'category_id' => $note->course->category_id ?? null,
                ];
            });

        return response()->json($notes);
    }

    public function viewnote($id)
    {
        $note = Act::findOrFail($id);

        if (!Storage::disk('public')->exists($note->file_path)) {
            abort(404);
        }

        $note->increment('download_count');

        $path = Storage::disk('public')->path($note->file_path);

        return response()->download($path);
    }

    public function viewnotes($id)
    {
        $note = Act::findOrFail($id);

        if (!Storage::disk('public')->exists($note->file_path)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($note->file_path);

        return response()->file($path);
    }
}