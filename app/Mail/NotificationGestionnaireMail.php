<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationGestionnaireMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contenu;

    /**
     * Crée une nouvelle instance de NotificationGestionnaireMail.
     *
     * @param  string  $contenu
     * @return void
     */
    public function __construct($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notification-gestionnaire')
            ->with([
                'contenu' => $this->contenu,
            ]);
    }
}
