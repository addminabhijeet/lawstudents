<?php

namespace App\Models;

use App\Models\CourseNote;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'category_id',
        'instructor_id',
        'title',
        'slug',
        'short_description',
        'description',
        'price',
        'level',
        'duration',
        'discount',     
        'is_free',
        'status',
        'thumbnail',
        'brochure',     
        'delete'
    ];

    protected $casts = [
        'is_free' => 'boolean',
        'status'  => 'boolean',
        'price'   => 'decimal:2',
        'discount'=> 'decimal:2' 
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function notes()
    {
        return $this->hasMany(CourseNote::class);
    }

    // Additive relation — Subject grouping level (Subject → Chapters/PDF
    // notes) added for the doc's Course Page Structure. Does not change
    // notes()/category() above or anything that already uses them.
    public function subjects()
    {
        return $this->hasMany(CourseSubject::class)->where('delete', 1)->orderBy('sort_order');
    }
}