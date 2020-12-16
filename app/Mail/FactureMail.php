<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FactureMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vente;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vente)
    {
        $this->vente = $vente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Facture, Art-Technic.')->markdown('emails.facture');
    }
}

/*
   Parametrage de l'envoi d'e-mail sur Laravel, modifier le fichier .env, variable d'environnement MAIL_DRIVER :
   -soit en local :
        MAIL_DRIVER=log
        l' e-mail est envoyé dans  storage/log/larravel.log

   -soit en vrai adresse gmail :

   MAIL_DRIVER=smtp
   MAIL_HOST=smtp.googlemail.com
   MAIL_PORT=465
   MAIL_USERNAME= email de l'emetteur
   MAIL_PASSWORD=*****
   MAIL_ENCRYPTION=ssl

    Sur l'adresse e-mail qui sert d'emetteur, activer l'option dans l'onglet sécurite : "Accès moins sécurisé des applications"


   -soit via un site de simulation d'email : mailtrap.io

    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=
    MAIL_PASSWORD=

   */
