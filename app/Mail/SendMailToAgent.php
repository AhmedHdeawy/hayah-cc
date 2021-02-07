<?php

namespace App\Mail;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailToAgent extends Mailable
{
    use Queueable, SerializesModels;

    public $property;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Property $property, array $data)
    {
        $this->property = $property;
        $this->data     = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('About your property')->view('mail.mailToAgent');
    }
}
