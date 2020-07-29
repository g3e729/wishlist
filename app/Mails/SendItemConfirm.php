<?php

namespace App\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendItemConfirm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        $this->wishlist = $item->wishlist;
        $this->to_user = $item->buyer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try {
            return $this->subject('You Have Chosen A Wish')
                ->view('emails.chosen', [
                    'wishlist_title' => $this->wishlist->title,
                    'name' => $this->to_user->name,
                ]);
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return false;
        }
    }
}
