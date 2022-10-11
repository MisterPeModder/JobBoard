<?php

namespace App\Policies;

use App\Models\Advert;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertPolicy
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
     *
     * @param  \App\Models\User|null  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User|null  $user
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Advert $advert)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        // user may only create advert if they are part of a company
        return $user->company_id !== null;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Advert $advert)
    {
        return $user->isMemberOf($advert->company);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Advert $advert)
    {
        return $user->isMemberOf($advert->company);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Advert $advert)
    {
        return $this->delete($user, $advert);
    }
}
