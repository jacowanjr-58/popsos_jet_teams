<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function edit(User $user)
    {
        $permissionGroups = config('permission-groups');
        $assignedPermissions = $user->permissions->pluck('name')->toArray();
        return view('permissions.assign', compact('user', 'permissionGroups', 'assignedPermissions'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'permissions' => 'nullable|array'
        ]);

        $user->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('permissions.assign', $user)->with('success', 'Permissions updated.');
    }
}
