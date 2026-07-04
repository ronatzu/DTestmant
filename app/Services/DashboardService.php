<?php

namespace App\Services;

use App\Enums\WorkOrderStatus;
use App\Models\Asset;
use App\Models\PreventiveMaintenance;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Collection;

class DashboardService
{
    /**
     * @return array{assets:int,open:int,completed:int,upcoming:int,technicians:int}
     */
    public function metrics(): array
    {
        return [
            'assets' => Asset::count(),
            'open' => WorkOrder::whereNotIn('status', [
                WorkOrderStatus::Completed->value,
                WorkOrderStatus::Cancelled->value,
            ])->count(),
            'completed' => WorkOrder::where('status', WorkOrderStatus::Completed->value)->count(),
            'upcoming' => PreventiveMaintenance::whereDate('next_maintenance', '>=', now())->count(),
            'technicians' => User::role('Technician')->count(),
        ];
    }

    public function activity(): Collection
    {
        return WorkOrder::with('asset', 'technician')
            ->latest()
            ->take(6)
            ->get();
    }
}
