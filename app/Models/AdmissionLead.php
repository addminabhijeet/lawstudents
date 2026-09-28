<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionLead extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'submitted_at' => 'datetime', 'consent_at' => 'datetime',
        'first_response_at' => 'datetime', 'next_follow_up_at' => 'datetime', 'enrolled_at' => 'datetime',
    ];

    public function student() { return $this->belongsTo(Student::class); }
    public function assignedAdmin() { return $this->belongsTo(Admin::class, 'assigned_admin_id'); }
    public function followUps() { return $this->hasMany(LeadFollowUp::class); }
}
