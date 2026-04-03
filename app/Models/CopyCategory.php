<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopyCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function subcategories()
    {
        return $this->hasMany(CopySubcategory::class, 'copy_category_id');
    }

    public function copys()
    {
        return $this->hasMany(Copy::class, 'category_id');
    }
}
