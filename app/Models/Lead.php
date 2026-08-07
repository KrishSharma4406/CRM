<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'status',
        'assigned_to',
    ];

    /**
     * The possible statuses for a lead.
     */
    public const STATUSES = [
        'new',
        'contacted',
        'qualified',
        'lost',
        'converted',
    ];

    /**
     * Get the user this lead is assigned to.
     */
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
