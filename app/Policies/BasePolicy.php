<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BasePolicy
{
    protected $permissions;

    /**
     * Get Permisisons
     *
     * @return array
     */
    public function getPermissions()
    {
        if ($this->permissions) {
            return $this->permissions;
        }

        $permissions = $this->getPermissionOfUser(Auth::user());
        $this->permissions = $permissions;
        return $permissions;
    }

    /**
     * Get permission of user
     *
     * @param User $user user
     *
     * @return array
     */
    public function getPermissionOfUser(User $user)
    {
        return User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->join('permission_role', 'roles.id', '=', 'permission_role.role_id')
            ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
            ->where('users.id', $user->id)
            ->get([
                DB::raw('users.id as user_id'),
                DB::raw('permissions.name as permission_name'),
                DB::raw('roles.name as role_name'),
            ])->pluck('permission_name')->toArray();
    }
}
