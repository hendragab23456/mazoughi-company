<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'amount',
        'account_type',
        'description',
        'transaction_date',
        'status',
        'created_by',
        'approved_by',
        'approved_at',
        'rejection_reason',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'date',
        'approved_at' => 'datetime',
    ];

    // المحاسب/المستخدم الذي أنشأ العملية
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // رجب الذي وافق أو رفض
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // هل العملية معلقة؟
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    // هل العملية مقبولة؟
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    // هل العملية مرفوضة؟
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}