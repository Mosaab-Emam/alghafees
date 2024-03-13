<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Models\Permission\Permission;
use App\Models\Permission\Role;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:roles.edit';

    protected function fillForm(): void
    {
        $this->form->fill([
            'title' => $this->record->title,
            'name' => $this->record->name,
            'permissions' => $this->record->permissions_ids
        ]) ;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);
        $permissions = $data['permissions'];
        $record->permissions()->sync($permissions);
        return $record;
    }
}
