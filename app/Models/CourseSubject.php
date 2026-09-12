<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// New model — the "Subject" grouping level between a Course and its PDF
// chapter notes (see course_subjects migration). Doesn't touch Course or
// CourseNote's existing behavior; those only gained new, additive relation
// methods alongside this.
class CourseSubject extends Model
{
    protected $fillable = [
        'course_id',
        'name',
        'sort_order',
        'delete',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Chapters — each is a CourseNote (Title, Short Description, PDF) scoped to this subject.
    public function chapters()
    {
        return $this->hasMany(CourseNote::class, 'subject_id')->orderBy('id');
    }
}
