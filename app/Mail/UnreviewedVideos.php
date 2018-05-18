<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UnreviewedVideos extends Mailable
{
    use Queueable, SerializesModels;

    public $videos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($videos)
    {
        $this->videos = $videos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.unreviewed_videos');
    }
}
