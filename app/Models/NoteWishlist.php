<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteWishlist extends Model
{
    protected $fillable = [
        'student_id',
        'note_id'
    ];
}