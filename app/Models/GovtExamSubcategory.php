<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovtExamSubcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'govt_exam_category_id', 'delete'];

    public function category()
    {
        return $this->belongsTo(GovtExamCategory::class, 'govt_exam_category_id');
    }

    public function exams()
    {
        return $this->hasMany(GovtExam::class, 'subcategory_id');
    }
}
