<?php

namespace Database\Seeders;

use App\Enums\WorkOrderStatus;
use App\Models\Asset;
use App\Models\PreventiveMaintenance;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Administrator', 'Supervisor', 'Technician'] as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        $admin = User::factory()->create([
            'name' => 'Avery Stone',
            'email' => 'admin@mantsoft.test',
            'password' => Hash::make('password'),
            'phone' => '(555) 010-1000',
            'avatar' => 'AS',
            'status' => 'active',
        ]);
        $admin->assignRole('Administrator');

        User::factory()->count(2)->create()->each->assignRole('Supervisor');
        User::factory()->count(7)->create()->each->assignRole('Technician');

        Asset::factory()->count(20)->create();

        $assets = Asset::query()->get();
        $technicians = User::role(['Technician', 'Supervisor'])->get();

        WorkOrder::factory()
            ->count(50)
            ->state(fn () => [
                'asset_id' => $assets->random()->id,
                'technician_id' => $technicians->random()->id,
            ])
            ->create()
            ->each(function (WorkOrder $workOrder): void {
                foreach ([WorkOrderStatus::Pending, $workOrder->status] as $status) {
                    $workOrder->timeline()->create([
                        'status' => $status,
                        'note' => $status->label().' by demo workflow',
                        'changed_at' => now()->subDays(fake()->numberBetween(1, 20)),
                    ]);
                }
            });

        PreventiveMaintenance::factory()
            ->count(30)
            ->state(fn () => [
                'asset_id' => $assets->random()->id,
                'technician_id' => $technicians->random()->id,
            ])
            ->create();
    }
}
