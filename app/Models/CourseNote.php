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
    ];

    // Relationship
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Accessor for readable size
    public function getFormattedSizeAttribute()
    {
        return $this->file_size
            ? number_format($this->file_size / 1024, 2) . ' KB'
            : null;
    }
}
