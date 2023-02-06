<?php

namespace App\Notifications;

use App\Channels\Messages\WhatsAppMessage;
use App\Channels\WhatsAppChannel;
use App\Models\Period;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AwardeeReminder extends Notification
{
    use Queueable;

    public $awardee;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->awardee = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WhatsAppChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toWhatsapp($notifiable)
    {
        $period = Period::find(1);
        $semester = ucfirst($period->semester);
        $year = date('Y');
        return (new WhatsAppMessage)
            ->content("Halo, Mahasiswa atas Nama {$this->awardee->name} dengan NIM {$this->awardee->awardee->nim} Universitas Negeri Surabaya.\n\nSilahkan segera melengkapi Berkas Semester Beasiswa Cendekia BAZNAS Melalui Link Web SIMONBEA BAZNAS.\n\nAdapun list dokumen yang harus di lengkapi :\n1. File IPK Semester {$semester} Periode {$year}\n\nKami Mohon Segera Melengkapi Data yang diperlukan dalam waktu 1x24 Jam . Apabila melebihi kurun waktu tersebut, pencairan dana beasiswa tidak dapat kami proses.\n\nTerima Kasih atas Kerjasamanya!");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
