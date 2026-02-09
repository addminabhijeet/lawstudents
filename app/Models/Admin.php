<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    // Table name (optional if it follows Laravel convention)
    protected $table = 'admins';

    // Primary key (optional if it follows Laravel convention)
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Mutator to hash password automatically when set
     */
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
