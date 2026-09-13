<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear cached permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [
            // Dashboard
            'dashboard.view',

            // Transactions
            'transactions.view',
            'transactions.create',
            'transactions.update',
            'transactions.delete',

            // Approval
            'transactions.approve',
            'transactions.reject',

            // Projects
            'projects.view',
            'projects.create',
            'projects.update',
            'projects.delete',

            // Workers
            'workers.view',
            'workers.create',
            'workers.update',
            'workers.delete',

            // Clients
            'clients.view',
            'clients.create',
            'clients.update',
            'clients.delete',

            // Suppliers
            'suppliers.view',
            'suppliers.create',
            'suppliers.update',
            'suppliers.delete',

            // Purchases
            'purchases.view',
            'purchases.create',
            'purchases.update',
            'purchases.delete',

            // Vehicles
            'vehicles.view',
            'vehicles.create',
            'vehicles.update',
            'vehicles.delete',

            // Equipment
            'equipment.view',
            'equipment.create',
            'equipment.update',
            'equipment.delete',

            // Custodies
            'custodies.view',
            'custodies.create',
            'custodies.update',
            'custodies.delete',

            // Invoices
            'invoices.view',
            'invoices.create',
            'invoices.update',
            'invoices.delete',

            // Reports
            'reports.view',

            // Notifications
            'notifications.view',

            // Users
            'users.view',
            'users.create',
            'users.update',
            'users.delete',

            // Roles & Permissions
            'roles.manage',

            // Audit log
            'audit.view',

            // Settings
            'settings.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Owner
        |--------------------------------------------------------------------------
        */

        $owner = Role::firstOrCreate([
            'name' => 'Owner',
            'guard_name' => 'web',
        ]);

        $owner->syncPermissions($permissions);

        /*
        |--------------------------------------------------------------------------
        | Accountant
        |--------------------------------------------------------------------------
        */

        $accountant = Role::firstOrCreate([
            'name' => 'Accountant',
            'guard_name' => 'web',
        ]);

        $accountant->syncPermissions([
            'dashboard.view',

            'transactions.view',
            'transactions.create',

            'projects.view',

            'workers.view',

            'clients.view',

            'suppliers.view',

            'purchases.view',
            'purchases.create',

            'vehicles.view',

            'equipment.view',

            'custodies.view',
            'custodies.create',

            'invoices.view',
            'invoices.create',

            'notifications.view',
        ]);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}