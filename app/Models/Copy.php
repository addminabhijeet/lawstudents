<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    use HasFactory;

    protected $table = 'copys';
    
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
        return $this->belongsTo(CopyCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(CopySubcategory::class, 'subcategory_id');
    }
}
