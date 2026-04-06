<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientele extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'pdfs',
        'delete',
    ];
}
