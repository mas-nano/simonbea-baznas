<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class WhatsAppChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWhatsapp($notifiable);

        $to = $notifiable->routeNotificationFor('WhatsApp');
        $from = config('services.twilio.whatsapp_from');

        $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

        $send = [
            "from" => 'whatsapp:' . $from,
            "body" => $message->content
        ];

        if ($message->media != '') {
            $send['mediaUrl'] = [$message->media];
        }
        // dd($send);
        return $twilio->messages->create('whatsapp:' . $to, $send);
    }
}
