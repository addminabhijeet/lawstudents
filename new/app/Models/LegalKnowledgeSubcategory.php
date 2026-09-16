<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalKnowledgeSubcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'legal_knowledge_category_id', 'delete'];

    public function category()
    {
        return $this->belongsTo(LegalKnowledgeCategory::class, 'legal_knowledge_category_id');
    }

    public function notes()
    {
        return $this->hasMany(LegalKnowledgeNote::class, 'subcategory_id');
    }
}
