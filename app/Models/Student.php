<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    // Table name (optional if following Laravel convention)
    protected $table = 'students';

    // Primary key (optional if following Laravel convention)
    protected $primaryKey = 'id';

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    // Hidden attributes (e.g., for arrays or JSON)
    protected $hidden = [
        'password',
    ];

    // Cast attributes to native types
    protected $casts = [
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
        'otp_expires_at' => 'datetime',
    ];


    /**
     * Mutator to hash password automatically when set
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

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function paidCourses()
    {
        return $this->hasMany(Payment::class, 'student_id');
    }
}
