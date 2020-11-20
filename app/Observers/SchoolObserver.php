<?php

namespace App\Observers;

use App\Mail\SchoolActivated;
use App\Models\Semester;
use App\Models\User;
use App\School;
use Illuminate\Support\Facades\Mail;

class SchoolObserver
{
    /**
     * Handle the school "created" event.
     *
     * @param  \App\School  $school
     * @return void
     */
    public function created(School $school)
    {
        //
    }

    /**
     * Handle the school "updated" event.
     *
     * @param  \App\School  $school
     * @return void
     */
    public function updated(School $school)
    {
        // chedk if the school is active or not if active chnage to inactive else active

        if ($school->getOriginal('is_active') == false && $school->is_active == true) {
                    // send mail to school owner
                    // dd('school is active');
                    Mail::to($school->email)->send(new SchoolActivated($school));
                    // $school->owner('role_id')
                   $user_role_school = User::where('id', $school->user_id)->update(['role_id' => 16]); // owner id 

        }else {

            Mail::to($school->email)->send(new SchoolActivated($school));
            // $school->owner('role_id')
           $user_role_school = User::where('id', $school->user_id)->update(['role_id' => 1]); // owner id 
        }
    }

    /**
     * Handle the school "deleted" event.
     *
     * @param  \App\School  $school
     * @return void
     */
    public function deleted(School $school)
    {
        //
    }

    /**
     * Handle the school "restored" event.
     *
     * @param  \App\School  $school
     * @return void
     */
    public function restored(School $school)
    {
        //
    }

    /**
     * Handle the school "force deleted" event.
     *
     * @param  \App\School  $school
     * @return void
     */
    public function forceDeleted(School $school)
    {
        //
    }
}
