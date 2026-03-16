<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'student_id',
        'course_id',
        'invoice_label',
        'invoice_number',
        'invoice_product',
        'issue_date',
        'due_date',

        'from_name',
        'from_email',
        'from_phone',
        'from_address',

        'to_name',
        'to_email',
        'to_phone',
        'to_address',

        'items',

        'sub_total',
        'tax_percentage',
        'tax_amount',
        'discount',
        'grand_total',

        'currency',

        'payment_method',
        'payment_status',

        'invoice_note',
        'late_fees',
        'client_note_enabled',
        'save_payment',
    ];

    protected $casts = [
        'items' => 'array',
        'issue_date' => 'date',
        'due_date' => 'date',
        'sub_total' => 'decimal:2',
        'tax_percentage' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'late_fees' => 'boolean',
        'client_note_enabled' => 'boolean',
        'save_payment' => 'boolean',
    ];

    /**
     * Relationship: Payment belongs to Student
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
