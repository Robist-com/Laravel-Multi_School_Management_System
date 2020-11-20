<?php

namespace App\Policies;

use App\School;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        
    }

    public function before( $user, $ability)
    {
        if ($user->role_id == 1) {
            
            return true;
        }
    }

    /**
     * Determine whether the user can view any schools.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
       
    }

    /**
     * Determine whether the user can view the school.
     *
     * @param  \App\User  $user
     * @param  \App\School  $school
     * @return mixed
     */
    public function view(User $user, School $school)
    {
        return $user->id === $school->user_id;
    }

    /**
     * Determine whether the user can create schools.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the school.
     *
     * @param  \App\User  $user
     * @param  \App\School  $school
     * @return mixed
     */
    public function update(User $user, School $school)
    {

        $test = $user->id === $school->user_id;
        dd($test);
        return ;

    }

    /**
     * Determine whether the user can delete the school.
     *
     * @param  \App\User  $user
     * @param  \App\School  $school
     * @return mixed
     */
    public function delete(User $user, School $school)
    {
        // return $user->id == $school->user_id;
    }

    /**
     * Determine whether the user can restore the school.
     *
     * @param  \App\User  $user
     * @param  \App\School  $school
     * @return mixed
     */
    public function restore(User $user, School $school)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the school.
     *
     * @param  \App\User  $user
     * @param  \App\School  $school
     * @return mixed
     */
    public function forceDelete(User $user, School $school)
    {
        //
    }
}
