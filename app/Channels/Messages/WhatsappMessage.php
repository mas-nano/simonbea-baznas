<?php


namespace App\Channels\Messages;

class WhatsAppMessage
{
    public $content;
    public $media;

    public function content($content, $media = '')
    {
        $this->content = $content;
        $this->media = $media;
        return $this;
    }
}
