<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovtExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'description',
        'pdfs',
        'delete',
    ];

    // ✅ SAME AS RULE
    protected $casts = [
        'pdfs' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(GovtExamCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(GovtExamSubcategory::class, 'subcategory_id');
    }
}
