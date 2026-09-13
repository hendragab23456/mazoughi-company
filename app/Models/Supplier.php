<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
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
}