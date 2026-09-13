<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'company',
        'address',
        'total_due',
        'total_paid',
        'notes',
    ];

    protected $casts = [
        'total_due' => 'decimal:2',
        'total_paid' => 'decimal:2',
    ];

    public function getRemainingAttribute(): float
    {
        return (float) $this->total_due - (float) $this->total_paid;
    }

    public function hasRemaining(): bool
    {
        return $this->remaining > 0;
    }

}