<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'description',
        'pdfs', // JSON column
    ];

    public function category()
    {
        return $this->belongsTo(ActCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(ActSubcategory::class, 'subcategory_id');
    }
}