<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewBorrowerRequest extends Notification
{
    use Queueable;

    protected $borrower;

    public function __construct($borrower)
    {
        $this->borrower = $borrower;
    }

    // Channel notifikasi
    public function via($notifiable)
    {
        return ['database']; // bisa tambah 'mail' jika ingin email juga
    }

    // Data yang disimpan di database
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Ada peminjaman buku baru yang perlu dikonfirmasi.',
            'borrower_id' => $this->borrower->id,
            'user_name' => $this->borrower->user->name,
        ];
    }

    // Fallback array (optional)
    public function toArray($notifiable)
    {
        return $this->toDatabase($notifiable);
    }
}
