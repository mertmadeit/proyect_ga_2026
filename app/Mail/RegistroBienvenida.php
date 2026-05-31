<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistroBienvenida extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $nombre,
        public string $email,
        public string $passwordPlano
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenido a Virelle',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.registro_bienvenida',
            with: [
                'nombre' => $this->nombre,
                'email' => $this->email,
                'passwordPlano' => $this->passwordPlano,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
