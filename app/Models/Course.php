<?php

namespace App\Models;

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
        'is_free',
        'status',
        'thumbnail'
    ];

    protected $casts = [
        'is_free' => 'boolean',
        'status'  => 'boolean',
        'price'   => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
