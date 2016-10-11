<?php

namespace App\Policies;

use App\User;
use App\Fax;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class UserPolicy
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
    public function view(User $user, User $currentUser)
    {
        // if client admin
        if ($user->isClientAdmin())
        {
            // does user belong to the client that owns the user
            return $user->entity_id == $currentUser->entity_id;
        }
        // if company admin
        else if ($user->isCompanyAdmin())
        {
            // does user belong to a the parent company
            if ($currentUser->entity->type == 'client')
            {
                return $user->entity_id == $currentUser->entity->parent_id;
            }
            else if ($currentUser->entity->type == 'company') {
                return $user->entity_id == $currentUser->entity->id;
            }
        } else if ($user->isUser())
        {
            return $user->id == $currentUser->id;
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
        return $user->isSuperAdmin() || $user->isCompanyAdmin() || $user->isClientAdmin();
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
        return $user->isSuperAdmin() || $user->isCompanyAdmin() || $user->isClientAdmin();
    }

    /**
     * Determine whether the user can update the fax.
     *
     * @param  App\User  $user
     * @param  App\Fax  $fax
     * @return mixed
     */
    public function update(User $user, User $currentUser)
    {
        // if client admin
        if ($user->isClientAdmin())
        {

            // does user belong to the client who owns the fax
            return $user->entity_id == $currentUser->entity_id;
        }
        // if company admin
        else if ($user->isCompanyAdmin())
        {
            // does user belong to a the parent company
            if ($currentUser->entity->type == 'client')
            {
                return $user->entity_id == $currentUser->entity->parent_id;
            }
            else if ($currentUser->entity->type == 'company') {
                return $user->entity_id == $currentUser->entity->id;
            }
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
        return $user->isSuperAdmin() || $user->isCompanyAdmin();
    }
}
