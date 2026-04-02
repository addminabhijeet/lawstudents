<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleSubcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rule_category_id',
        'pdfs', // JSON field for multiple PDFs
    ];

    protected $casts = [
        'pdfs' => 'array',
    ];

    // A subcategory belongs to a category
    public function category()
    {
        return $this->belongsTo(RuleCategory::class, 'rule_category_id');
    }

    // Optional: a subcategory may have many rules
    public function rules()
    {
        return $this->hasMany(Rule::class, 'subcategory_id');
    }
}