<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappSetting extends Model
{
    protected $table = 'whatsappsettings';

    protected $fillable = [
        'whatsapp_number',
        'pre_message'
    ];
}
