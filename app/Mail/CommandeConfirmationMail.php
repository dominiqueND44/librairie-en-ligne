<?php

namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommandeConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;

    /**
     * Crée une nouvelle instance de la classe Mailable.
     *
     * @param Commande $commande
     * @return void
     */
    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    /**
     * Construire le message de l'email.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmation de votre commande')
            ->view('emails.commandeConfirmation');
    }
}
