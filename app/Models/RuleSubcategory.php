<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleSubcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rule_category_id'];

    public function category()
    {
        return $this->belongsTo(RuleCategory::class, 'rule_category_id');
    }

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }
}