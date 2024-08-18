<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $type_contact;
    public $message;
    public $phone;
    public $email;
    public $full_name;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type_contact,$message,$phone,$email,$full_name)
    {
        $this->type_contact = $type_contact;
        $this->message = $message;
        $this->phone = $phone;
        $this->email = $email;
        $this->full_name = $full_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Contact US - '. $this->type_contact)
        ->markdown('mail.contactus');
    }
}
