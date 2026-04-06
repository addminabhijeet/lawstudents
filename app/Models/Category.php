<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'parent_id',
        'status',
        'sort_order',
        'delete'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->where('status', 1)
            ->orderBy('sort_order');
    }

    public function courses()
    {
        return $this->hasMany(Course::class)
            ->where('status', 1);
    }
}
