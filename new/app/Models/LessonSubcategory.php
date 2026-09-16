<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessionSubcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lession_category_id'];

    public function category()
    {
        return $this->belongsTo(LessionCategory::class, 'lession_category_id');
    }

    public function lessions()
    {
        return $this->hasMany(Lession::class, 'subcategory_id');
    }
}
