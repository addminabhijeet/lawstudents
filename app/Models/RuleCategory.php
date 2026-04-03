<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function subcategories()
    {
        return $this->hasMany(RuleSubcategory::class, 'rule_category_id');
    }

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }
}