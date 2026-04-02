<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pdfs', // JSON field for multiple PDFs
    ];

    // Cast PDFs field to array automatically
    protected $casts = [
        'pdfs' => 'array',
    ];

    // A category has many subcategories
    public function subcategories()
    {
        return $this->hasMany(RuleSubcategory::class);
    }

    // Optional: a category may have many rules directly
    public function rules()
    {
        return $this->hasMany(Rule::class, 'category_id');
    }
}