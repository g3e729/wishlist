<?php

namespace App\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvite extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invite, $user = null)
    {
        $this->invite = $invite;
        $this->wishlist = $invite->wishlist;
        $this->from_user = $invite->wishlist->organizer;
        $this->to_user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try {
            $invite_id = $this->invite->id;
            return $this->subject('You Have Been Invited!')
                ->view('emails.invite', [
                    'wishlist_title' => $this->wishlist->title,
                    'from_name' => $this->from_user->name,
                    'url' => $this->wishlist->public_url . '?' . http_build_query(compact('invite_id')),
                    'hasUser' => !is_null($this->to_user),
                    'register_url' => route('register.show', compact('invite_id'))
                ]);
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return false;
        }
    }
}
