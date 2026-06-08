<?php

namespace App\Mail;

use App\Models\Factura;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class FacturaCreada extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Factura $factura)
    {
        $this->factura->loadMissing(['cliente', 'forma', 'estado']);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva factura creada #' . $this->factura->numero,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.factura',
            with: [
                'factura' => $this->factura,
                'cliente' => $this->factura->cliente,
                'forma' => $this->factura->forma,
                'estado' => $this->factura->estado,
            ],
        );
    }

    public function attachments(): array
    {
        if (empty($this->factura->archivo) || !Storage::disk('archivos')->exists($this->factura->archivo)) {
            return [];
        }

        return [
            Attachment::fromPath(Storage::disk('archivos')->path($this->factura->archivo))
                ->as($this->factura->archivo)
                ->withMime('application/pdf'),
        ];
    }
}
