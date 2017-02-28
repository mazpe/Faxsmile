<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can index companies.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can view the company.
     *
     * @param  App\User  $user
     * @param  App\Setting  $setting
     * @return mixed
     */
    public function view(User $user, Company $setting)
    {
        return ($user->entity_id == $setting->id) &&  $user->isCompanyAdmin();
    }

    /**
     * Determine whether the user can create companies.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isSuperAdmin() || $user->isCompanyAdmin() || $user->isClientAdmin();
    }

    /**
     * Determine whether the user can update the company.
     *
     * @param  App\User  $user
     * @param  App\Setting  $setting
     * @return mixed
     */
    public function update(User $user, Company $setting)
    {
        return ($user->entity_id == $setting->id) &&  $user->isCompanyAdmin();
    }

    /**
     * Determine whether the user can delete the company.
     *
     * @param  App\User  $user
     * @param  App\Setting  $setting
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->isSuperAdmin();
    }
}
