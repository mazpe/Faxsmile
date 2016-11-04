<?php

namespace App\Policies;

use App\User;
use App\EmailConfig;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmailConfigPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        dd('here');
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
     * @param  App\EmailConfig  $emailConfig
     * @return mixed
     */
    public function view(User $user, Company $emailConfig)
    {
        return ($user->entity_id == $emailConfig->id) &&  $user->isCompanyAdmin();
    }

    /**
     * Determine whether the user can create companies.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        dd($user);
        return $user->isSuperAdmin() || $user->isCompanyAdmin() || $user->isClientAdmin();
    }

    /**
     * Determine whether the user can update the company.
     *
     * @param  App\User  $user
     * @param  App\EmailConfig  $emailConfig
     * @return mixed
     */
    public function update(User $user, Company $emailConfig)
    {
        return ($user->entity_id == $emailConfig->id) &&  $user->isCompanyAdmin();
    }

    /**
     * Determine whether the user can delete the company.
     *
     * @param  App\User  $user
     * @param  App\EmailConfig  $emailConfig
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->isSuperAdmin();
    }
}
