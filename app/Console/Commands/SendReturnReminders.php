<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Borrower;
use App\Mail\ReturnReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendReturnReminders extends Command
{
    protected $signature = 'reminder:returns';
    protected $description = 'Send reminder email to borrowers before return date';

    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        $borrowers = Borrower::whereDate('tgl_kembali', $tomorrow)->with('user', 'book')->get();

        foreach ($borrowers as $borrower) {
            Mail::to($borrower->user->email)->send(new ReturnReminderMail($borrower));
        }

        $this->info('Reminder emails sent successfully.');
    }
}
