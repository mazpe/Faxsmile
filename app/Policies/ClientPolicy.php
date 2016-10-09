<?php

namespace App\Policies;

use App\User;
use App\Client;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can index clients.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->isSuperAdmin() || $user->isCompanyAdmin();
    }

    /**
     * Determine whether the user can view the client.
     *
     * @param  App\User  $user
     * @param  App\Client  $client
     * @return mixed
     */
    public function view(User $user, Client $client)
    {
        // if client admin
        if ($user->isClientAdmin())
        {
            // does user belong to the client
            return $user->entity_id == $client->id;
        }
        // if company admin
        else if ($user->isCompanyAdmin())
        {
            // does user belong to a the parent company
            return $user->entity_id == $client->parent_id;
        }

        return false;
    }

    /**
     * Determine whether the user can create clients.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isSuperAdmin() || $user->isCompanyAdmin();
    }

    /**
     * Determine whether the user can create clients.
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
     * Determine whether the user can update the client.
     *
     * @param  App\User  $user
     * @param  App\Client  $client
     * @return mixed
     */
    public function update(User $user, Client $client)
    {
        // if client admin
        if ($user->isClientAdmin())
        {
            // does user belong to the client
            return $user->entity_id == $client->id;
        }
        // if company admin
        else if ($user->isCompanyAdmin())
        {
            // does user belong to a the parent company
            return $user->entity_id == $client->parent_id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the client.
     *
     * @param  App\User  $user
     * @param  App\Client  $client
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->isSuperAdmin() || $user->isCompanyAdmin();
    }
}
