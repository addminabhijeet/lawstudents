<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Course;
use App\Models\Category;
use App\Models\CourseNote;
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

    public function viewNote($id)
    {
        $note = CourseNote::findOrFail($id);

        if (!Storage::disk('public')->exists($note->file_path)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($note->file_path);

        return response()->file($path);
    }
}
