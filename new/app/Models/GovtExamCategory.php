<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovtExamCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'delete'];

    public function subcategories()
    {
        return $this->hasMany(GovtExamSubcategory::class, 'govt_exam_category_id');
    }

    public function exams()
    {
        return $this->hasMany(GovtExam::class, 'category_id');
    }
}
