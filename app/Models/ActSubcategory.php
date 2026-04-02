<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActSubcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'act_category_id'];

    public function category()
    {
        return $this->belongsTo(ActCategory::class);
    }

    public function acts()
    {
        return $this->hasMany(Act::class);
    }
}
