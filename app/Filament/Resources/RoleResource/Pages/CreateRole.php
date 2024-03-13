<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Models\Permission\Permission;
use App\Models\Permission\Role;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:roles.create';

    protected function handleRecordCreation(array $data): Model
    {
      $role =  Role::create($data);
        $permissions = $data['permissions'];
        if (!empty($permissions)) {
            foreach ($permissions as $permission) {
                $permission = Permission::where('id', $permission)->firstOrFail();
                $role->permissions()->detach($permission->id);
                $role->permissions()->attach($permission->id);
            }
        }
        return $role;
    }
}
