<?php

namespace App\Policies;

use App\Models\admin\admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\user\User  $user
     * @return mixed
     */
    public function viewAny(admin $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\user\admin  $user
     * @param  \App\Models\post  $post
     * @return mixed
     */
    public function view(admin $user)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\user\admin  $user
     * @return mixed
     */
    public function create(admin $user)
    {
        return $this->getPermission($user,4);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\user\admin  $user
     * @param  \App\Models\post  $post
     * @return mixed
     */
    public function update(admin $user)
    {
        return $this->getPermission($user,5);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\user\admin  $user
     * @param  \App\Models\post  $post
     * @return mixed
     */
    public function delete(admin $user)
    {
        return $this->getPermission($user,7);
    }

    public function tag(admin $user)
    {
        return $this->getPermission($user,15);
    }

    public function category(admin $user)
    {
        return $this->getPermission($user,16);
    }

    public function userCreate(admin $user)
    {
        return $this->getPermission($user,8);
    }

    public function userUpdate(admin $user)
    {
        return $this->getPermission($user,9);
    }

    public function userDelete(admin $user)
    {
        return $this->getPermission($user,10);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\user\admin  $user
     * @param  \App\Models\post  $post
     * @return mixed
     */
    public function restore(admin $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\user\admin  $user
     * @param  \App\Models\post  $post
     * @return mixed
     */
    public function forceDelete(admin $user)
    {
        //
    }

    protected function getPermission($user,$p_id)
    {
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->id == $p_id) {   // $p_id is id of post-create in permission table
                    return true;
                }
            }
        }
        return false;
    }
}
