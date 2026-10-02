<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PdfWatermarkSetting extends Model
{
    protected $fillable = ['path_hash', 'file_path', 'enabled'];

    protected $casts = ['enabled' => 'boolean'];
}
