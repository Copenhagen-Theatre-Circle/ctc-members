<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuditionForm extends Mailable
{
    use Queueable, SerializesModels;

    public $person;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($person, $link)
    {
        $this->person = $person;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('Link to full CTC Audition Form')
        ->text('mails.audition_form');
    }
}
