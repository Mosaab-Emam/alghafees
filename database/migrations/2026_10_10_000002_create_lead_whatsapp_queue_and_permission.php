<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    public function up(): void
    {
        // Queue payloads contain a batch identifier only, never phone numbers or message text.
        Schema::create('lead_whatsapp_jobs', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        app(PermissionRegistrar::class)->forgetCachedPermissions();
        $permission = Permission::findOrCreate('send_whatsapp_lead', 'web');
        Role::where('name', config('filament-shield.super_admin.name', 'المدير العام'))
            ->where('guard_name', 'web')->get()
            ->each(fn (Role $role) => $role->givePermissionTo($permission));
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_whatsapp_jobs');
        Permission::where('name', 'send_whatsapp_lead')->where('guard_name', 'web')->get()->each->delete();
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
};
