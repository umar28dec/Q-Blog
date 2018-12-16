<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function viewUsers(User $user)
    {
        return $user->privilege > 1;
    }


    /**
     * Determine whether the user can assign role to users.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function assignRole(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the profile which has the given slug.
     *
     * @param  \App\User  $user
     * @param  string     $slug the slug of the profile user want to updated
     * @return mixed
     */
    public function update(User $user, string $slug)
    {
        return $user->slug === $slug;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $deleted)
    {
        return $user->isAdmin() || $user->id == $deleted->id;
    }
}
