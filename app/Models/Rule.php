<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'description',
        'pdfs',
    ];

    // ✅ SAME AS ACT
    protected $casts = [
        'pdfs' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(RuleCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(RuleSubcategory::class, 'subcategory_id');
    }
}
