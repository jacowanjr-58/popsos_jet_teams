<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RoleRequest;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
{
    // Example: Only Franchise Admins and above can create users
    return $user->hasAnyRole(['Super Admin', 'Corporate Admin', 'Franchise Owner']);
}

    public function canApproveRoleRequest(User $user, RoleRequest $request): bool
    {
        $requestedRole = $request->desired_role;

        if ($user->hasRole('super_user')) {
            return true;
        }

        if ($user->hasRole('corporate_admin') && $requestedRole === 'franchise_admin') {
            return true;
        }

        if ($user->hasRole('franchise_admin') && in_array($requestedRole, ['franchise_manager', 'franchise_staff'])) {
            return $user->teams->pluck('id')->intersect($request->franchise_ids)->isNotEmpty();
        }

        if ($user->hasRole('franchise_manager') && $requestedRole === 'franchise_staff') {
            return $user->teams->pluck('id')->intersect($request->franchise_ids)->isNotEmpty();
        }

        return false;
    }
}
