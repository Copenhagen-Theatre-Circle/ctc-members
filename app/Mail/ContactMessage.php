<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($attributes = null)
    {
        $this->attributes = $attributes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(!empty($this->attributes['replyTo']))
          $this->replyTo($this->attributes['replyTo']);

        if (!empty($this->attributes['fromName'])) {
          $fromName = $this->attributes['fromName'];
        } else {$fromName = "";}

        if (!empty($this->attributes['subject'])) {
          $subject = $this->attributes['subject'];
        } else {$subject = "";}

        if (!empty($this->attributes['body'])) {
          $body = $this->attributes['body'];
        } else {$body = "";}

        return $this->from('noreply@ctc-members.dk', $fromName . ' via ctc-members.dk')
                    ->subject($subject)
                    ->view('emails.contactmessage')
                    ->with(['body'=>$body, 'fromName'=>$fromName]);
    }
}
