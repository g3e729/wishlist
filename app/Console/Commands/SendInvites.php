<?php

namespace App\Console\Commands;

use App\Models\Invite;
use App\Mails\SendInvite;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendInvites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:invites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email invitations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $invites = Invite::with('user', 'wishlist')->whereSent(false)->get();

            foreach ($invites as $invite) {
                Mail::to($invite->email)->send(new SendInvite($invite, $invite->user));
                $invite->update(['sent' => true]);
            }

        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());

            return 'error';
        }
    }
}
