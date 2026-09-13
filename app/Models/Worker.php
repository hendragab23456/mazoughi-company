<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'job_title',
        'type',
        'total_due',
        'total_paid',
        'notes',
    ];

    protected $casts = [
        'total_due' => 'decimal:2',
        'total_paid' => 'decimal:2',
    ];

    // المبلغ المتبقي للعامل
    public function getRemainingAttribute(): float
    {
        return (float) $this->total_due - (float) $this->total_paid;
    }

    // هل للعامل مبلغ مستحق؟
    public function hasRemaining(): bool
    {
        return $this->remaining > 0;
    }
}