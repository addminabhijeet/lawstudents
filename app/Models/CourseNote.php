<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseNote extends Model
{

    protected $fillable = [
        'course_id',
        'title',
        'file_path',
        'file_size',
        'page_count',
        'is_downloadable',
        'status',
        'download_count',
        'version',
        'visibility',
        'delete',
    ];

    // Relationship
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Accessor for readable size
    public function getFormattedSizeAttribute()
    {
        if (!$this->file_size) return '0 KB';

        $size = $this->file_size;

        if ($size >= 1048576) {
            return round($size / 1048576, 2) . ' MB';
        }

        return round($size / 1024, 2) . ' KB';
    }

    public function wishlists()
    {
        return $this->hasMany(NoteWishlist::class, 'note_id');
    }
}
