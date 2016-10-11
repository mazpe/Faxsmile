<?php

namespace App\Policies;

use App\User;
use App\Fax;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaxPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can index faxes.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->isSuperAdmin() || $user->isCompanyAdmin() || $user->isClientAdmin();
    }

    /**
     * Determine whether the user can view the fax.
     *
     * @param  App\User  $user
     * @param  App\Fax  $fax
     * @return mixed
     */
    public function view(User $user, Fax $fax)
    {
        // if client admin
        if ($user->isClientAdmin())
        {
            // does user belong to the client that owns the fax
            return $user->entity_id == $fax->client_id;
        }
        // if company admin
        else if ($user->isCompanyAdmin())
        {
            // does user belong to a the parent company
            return $user->entity_id == $fax->client->company->id;
        }

        return false;
    }

    /**
     * Determine whether the user can create faxes.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isSuperAdmin() || $user->isCompanyAdmin();
    }

    /**
     * Determine whether the user can create faxes.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        // TODO: should check if the $request->input('parent_id') == $user->company->id
        return $user->isSuperAdmin() || $user->isCompanyAdmin();
    }

    /**
     * Determine whether the user can update the fax.
     *
     * @param  App\User  $user
     * @param  App\Fax  $fax
     * @return mixed
     */
    public function update(User $user, Fax $fax)
    {
        // if client admin
        if ($user->isClientAdmin())
        {
            // does user belong to the client who owns the fax
            return $user->entity_id == $fax->client_id;
        }
        // if company admin
        else if ($user->isCompanyAdmin())
        {
            // does user belong to a the parent company
            return $user->entity_id == $fax->client->company->id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the fax.
     *
     * @param  App\User  $user
     * @param  App\Fax  $fax
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->isSuperAdmin() || $user->isCompanyAdmin() || $user->isClientAdmin();
    }
}
