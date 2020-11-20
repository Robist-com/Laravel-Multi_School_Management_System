<?php

namespace App\Mail;

use App\School;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SchoolActivationRequest extends Mailable
{
    use Queueable, SerializesModels;


    public $school;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(School $school)
    {
        $this->school = $school;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('auth.emails.school_activation');
    }
}
