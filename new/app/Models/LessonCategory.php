<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessionCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function subcategories()
    {
        return $this->hasMany(LessionSubcategory::class, 'lession_category_id');
    }

    public function lessions()
    {
        return $this->hasMany(Lession::class, 'category_id');
    }
}
