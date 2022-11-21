<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy extends BasePolicy
{
    use HandlesAuthorization;

 
    public function viewAny(User $user)
    {
        return in_array('view', $this->getPermissions());
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return in_array('view', $this->getPermissions());
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return in_array('create', $this->getPermissions());
    }


    public function update(User $user)
    {
        return in_array('update', $this->getPermissions());
    }


    public function delete(User $user, Category $category)
    {
        return in_array('delete', $this->getPermissions());
    }



    public function forceDelete(User $user, Category $category)
    {
        return in_array('delete', $this->getPermissions());
    }
}
