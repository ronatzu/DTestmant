<?php

namespace App\Enums;

enum WorkOrderStatus: string
{
    case Pending = 'pending';
    case Assigned = 'assigned';
    case InProgress = 'in_progress';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return str($this->value)->replace('_', ' ')->headline();
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'slate',
            self::Assigned => 'blue',
            self::InProgress => 'amber',
            self::Completed => 'emerald',
            self::Cancelled => 'rose',
        };
    }
}
