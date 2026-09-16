<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentActivity extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'note_id',
        'activity_type',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array'
    ];
}
