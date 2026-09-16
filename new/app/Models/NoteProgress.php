<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteProgress extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'note_id',
        'total_pages',
        'viewed_pages',
        'progress_percent'
    ];
}
