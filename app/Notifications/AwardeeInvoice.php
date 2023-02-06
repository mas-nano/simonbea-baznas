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

class AwardeeInvoice extends Notification
{
    use Queueable;

    public $awardee;
    public $path;
    public $fund;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $fund, $path = '')
    {
        $this->awardee = $user;
        $this->path = $path;
        $this->fund = $fund;
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
        $numFund = number_format($this->fund, 0, ".", ".");
        return (new WhatsAppMessage)
            ->content("Halo, Mahasiswa atas Nama {$this->awardee->name}. Dana Beasiswa Cendekia BAZNAS sudah DI TRANSFER ke Nomor Rekening {$this->awardee->account_number} Bank {$this->awardee->bank} atas Nama {$this->awardee->name} dengan Nominal Rp{$numFund}.\n\nUntuk Bukti Transfer Terlampir dalam Pesan ini.\nSilahkan cek untuk info status pencairan melalui web SIMONBEA BAZNAS.\n\nTerima kasih dan Semangat Selalu!", $this->path);
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
