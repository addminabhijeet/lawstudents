<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalKnowledgeCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'delete'];

    public function subcategories()
    {
        return $this->hasMany(LegalKnowledgeSubcategory::class, 'legal_knowledge_category_id');
    }

    public function notes()
    {
        return $this->hasMany(LegalKnowledgeNote::class, 'category_id');
    }
}
