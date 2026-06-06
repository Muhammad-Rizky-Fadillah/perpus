<?php

namespace App\Notifications;

use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewMemberRegistered extends Notification
{
    use Queueable;

    protected $member;

    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    public function via($notifiable)
    {
        return ['database']; // disimpan di database
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Pendaftaran anggota baru: ' . ($this->member->user->name ?? 'Tidak diketahui'),
            'member_id' => $this->member->id,
            'kode' => $this->member->kode,
        ];
    }
}
