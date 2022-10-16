<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.

     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $targetUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, User $targetUser)
    {
        return $user !== null && $user->id === $targetUser->id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $user)
    {
        return $user === null;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $targetUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $user, User $targetUser)
    {
        return $user !== null && $user->id === $targetUser->id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $targetUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $user, User $targetUser)
    {
        return $user !== null && $targetUser->user_id === $user->id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $targetUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(?User $user, User $targetUser)
    {
        return Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $targetUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $targetUser)
    {
        return $this->delete($user, $targetUser);
    }
}
