<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy extends BasePolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return in_array('view', $this->getPermissions());
    }


    public function view(User $user)
    {
        return in_array('view', $this->getPermissions());
    }

    public function create(User $user)
    {
        return in_array('create', $this->getPermissions());
    }


    public function update(User $user)
    {
        return in_array('update', $this->getPermissions());
    }


    public function delete(User $user)
    {
        return in_array('delete', $this->getPermissions());
    }



    public function forceDelete(User $user)
    {
        return in_array('delete', $this->getPermissions());
    }
}
