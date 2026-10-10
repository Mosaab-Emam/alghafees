<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    public function up(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [];
        foreach (['lead', 'lead::category'] as $resource) {
            $prefixes = ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'];
            if ($resource === 'lead') {
                $prefixes = array_merge($prefixes, ['import', 'export']);
            }
            foreach ($prefixes as $prefix) {
                $permissions[] = Permission::findOrCreate("{$prefix}_{$resource}", 'web');
            }
        }

        // Other roles can be granted these permissions through the existing Shield roles page.
        Role::where('name', config('filament-shield.super_admin.name', 'المدير العام'))
            ->where('guard_name', 'web')
            ->get()
            ->each(fn (Role $role) => $role->givePermissionTo($permissions));

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function down(): void
    {
        Permission::where('guard_name', 'web')->whereIn('name', [
            'view_any_lead', 'view_lead', 'create_lead', 'update_lead',
            'delete_lead', 'delete_any_lead', 'import_lead', 'export_lead',
            'view_any_lead::category', 'view_lead::category', 'create_lead::category',
            'update_lead::category', 'delete_lead::category', 'delete_any_lead::category',
        ])->get()->each->delete();

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
};
