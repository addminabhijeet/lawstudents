<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Course;
use App\Models\Category;
use App\Models\CourseNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FreeNotesController extends Controller
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
                        }]);
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
                                    }]);
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
            ->get();

        return view('notes.notes', compact('categories', 'courses'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (strlen($query) < 3) {
            return response()->json([]);
        }

        $notes = CourseNote::where('visibility', 'free')
            ->where('status', 1)
            ->where('title', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get()
            ->map(function ($note) {
                return [
                    'title' => $note->title,
                    'type' => 'Note',
                ];
            });

        $courses = Course::where('is_free', 1)
            ->where('title', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get()
            ->map(function ($course) {
                return [
                    'title' => $course->title,
                    'type' => 'Course',
                ];
            });

        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get()
            ->map(function ($category) {
                return [
                    'title' => $category->name,
                    'type' => 'Category',
                ];
            });

        return response()->json(
            $notes->merge($courses)->merge($categories)
        );
    }

    public function viewnote($id)
    {
        $note = CourseNote::findOrFail($id);

        if (!Storage::disk('public')->exists($note->file_path)) {
            abort(404);
        }

        $note->increment('download_count');

        $path = Storage::disk('public')->path($note->file_path);

        return response()->download($path);
    }

    public function viewnotes($id)
    {
        $note = CourseNote::findOrFail($id);

        if (!Storage::disk('public')->exists($note->file_path)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($note->file_path);

        return response()->file($path);
    }
}
