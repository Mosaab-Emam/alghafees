<?php

namespace App\Policies;

use App\Models\LeadCategory;
use App\Models\User;

class LeadCategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_lead::category');
    }

    public function view(User $user, LeadCategory $category): bool
    {
        return $user->can('view_lead::category');
    }

    public function create(User $user): bool
    {
        return $user->can('create_lead::category');
    }

    public function update(User $user, LeadCategory $category): bool
    {
        return $user->can('update_lead::category');
    }

    public function delete(User $user, LeadCategory $category): bool
    {
        return $user->can('delete_lead::category');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_lead::category');
    }
}
