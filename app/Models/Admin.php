<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    protected $table = 'admins';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
        'otp_expires_at' => 'datetime',
    ];

    /**
     * Auto hash password like Student model
     */
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function generateOtp()
    {
        $otp = random_int(100000, 999999);

        $this->otp = $otp;
        $this->otp_expires_at = now()->addMinutes(10);
        $this->save();

        return $otp;
    }

    public function clearOtp()
    {
        $this->otp = null;
        $this->otp_expires_at = null;
        $this->save();
    }
}
