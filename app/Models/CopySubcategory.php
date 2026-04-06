<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopySubcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'copy_category_id','delete'];

    public function category()
    {
        return $this->belongsTo(CopyCategory::class, 'copy_category_id');
    }

    public function copys()
    {
        return $this->hasMany(Copy::class, 'subcategory_id');
    }
}
