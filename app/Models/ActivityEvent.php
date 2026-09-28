<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityEvent extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $casts = ['metadata' => 'array', 'occurred_at' => 'datetime', 'created_at' => 'datetime'];
}
