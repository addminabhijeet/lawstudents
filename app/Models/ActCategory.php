<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function subcategories()
    {
        return $this->hasMany(ActSubcategory::class, 'act_category_id');
    }

    public function acts()
    {
        return $this->hasMany(Act::class, 'category_id');
    }
}