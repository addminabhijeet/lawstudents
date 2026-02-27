<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAdmission extends Model
{
    use HasFactory;

    protected $table = 'student_admissions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'student_id',
        'full_name',
        'dob',
        'email',
        'gender',
        'phone',
        'alternate_phone',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'pincode',
        'country',
        'aadhaar_number',
        'pan_number',
        'father_name',
        'mother_name',
        'guardian_phone',
        'guardian_email',
        'last_qualification',
        'board_university',
        'passing_year',
        'percentage',
        'course_name',
        'course_duration',
        'admission_session',
        'photo',
        'signature',
        'marksheet',
        'id_proof',
        'admission_status',
        'remarks',
        'email_otp',
        'phone_otp',
        'otp_expires_at',
        'email_verified',
        'phone_verified',
    ];

    protected $casts = [
        'dob' => 'date',
        'passing_year' => 'integer',
        'percentage' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship: Admission belongs to Student
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Scope: Pending Admissions
     */
    public function scopePending($query)
    {
        return $query->where('admission_status', 'pending');
    }

    /**
     * Scope: Approved Admissions
     */
    public function scopeApproved($query)
    {
        return $query->where('admission_status', 'approved');
    }

    /**
     * Scope: Rejected Admissions
     */
    public function scopeRejected($query)
    {
        return $query->where('admission_status', 'rejected');
    }
}
