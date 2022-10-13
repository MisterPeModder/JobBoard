<?php

namespace App\Policies;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AssetPolicy
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
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Asset $asset)
    {
        $allowed =
            // PRIVATE: user owns the asset OR the user's company owns the asset
            ($user !== null && ($asset->user_id === $user->id || $asset->company_id === $user->company_id))
            // PUBLIC: anyone can access
            || $asset->access === 'public';

        return $allowed ? Response::allow() : Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $user)
    {
        return true; // anyone can upload assets
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $user, Asset $asset)
    {
        return Response::denyAsNotFound(); // assets are immutable for regular users.
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $user, Asset $asset)
    {
        return $user !== null && $asset->user_id === $user->id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(?User $user, Asset $asset)
    {
        return Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Asset $asset)
    {
        return $this->delete($user, $asset);
    }
}
