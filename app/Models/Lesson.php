<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lession extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'description',
        'pdfs',
    ];

    protected $casts = [
        'pdfs' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(LessionCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(LessionSubcategory::class, 'subcategory_id');
    }
}
