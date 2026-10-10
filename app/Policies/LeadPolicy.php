<?php

namespace App\Policies;

use App\Models\Lead;
use App\Models\User;

class LeadPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_lead');
    }

    public function view(User $user, Lead $lead): bool
    {
        return $user->can('view_lead');
    }

    public function create(User $user): bool
    {
        return $user->can('create_lead');
    }

    public function update(User $user, Lead $lead): bool
    {
        return $user->can('update_lead');
    }

    public function delete(User $user, Lead $lead): bool
    {
        return $user->can('delete_lead');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_lead');
    }

    public function import(User $user): bool
    {
        return $user->can('import_lead') && $this->create($user) && $this->viewAny($user);
    }

    public function export(User $user): bool
    {
        return $user->can('export_lead') && $this->viewAny($user);
    }
}
