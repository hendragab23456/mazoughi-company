<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'client_name',
        'location',
        'budget',
        'total_expenses',
        'start_date',
        'end_date',
        'status',
        'description',
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'total_expenses' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function getRemainingBudgetAttribute(): float
    {
        return (float) $this->budget - (float) $this->total_expenses;
    }

    public function isOverBudget(): bool
    {
        return $this->total_expenses > $this->budget;
    }
}
