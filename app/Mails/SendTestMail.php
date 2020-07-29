<?php

namespace App\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.s
     *
     * @return $this
     */
    public function build()
    {
        try {
            return $this->subject('Test Mail')
                ->view('emails.test');
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return false;
        }
    }
}
