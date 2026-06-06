<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReturnReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $borrower, $book, $user, $returnDate;


    public function __construct($borrower)
    {
        $this->borrower = $borrower;
        $this->user = $borrower->user;
        $this->book = $borrower->book;
        $this->returnDate = $borrower->due_date;
    }


    public function build()
    {
        return $this->subject('Reminder Pengembalian Buku')
            ->view('emails.return_reminder');
    }
}
