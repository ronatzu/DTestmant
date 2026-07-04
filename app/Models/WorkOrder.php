<?php

namespace App\Models;

use App\Enums\Priority;
use App\Enums\WorkOrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'title',
        'description',
        'asset_id',
        'technician_id',
        'priority',
        'status',
        'start_date',
        'due_date',
        'completion_date',
    ];

    protected function casts(): array
    {
        return [
            'priority' => Priority::class,
            'status' => WorkOrderStatus::class,
            'start_date' => 'date',
            'due_date' => 'date',
            'completion_date' => 'date',
        ];
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function timeline(): HasMany
    {
        return $this->hasMany(WorkOrderTimeline::class);
    }
}
