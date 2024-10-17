<?php

namespace App\Mail;

use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;

use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnviarContrato extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected Reserva $reserva
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Envío de Contrato Jumping',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.reservas.contrato',
            with: [
                'pathToImage' => 'images/jumping-logo.png',
                'reservaId' => $this->reserva->id,
                'nombre' => "{$this->reserva->apellido}, {$this->reserva->nombre}",
                'fecha_desde' => Carbon::parse($this->reserva->fecha_desde)->format('d/m/Y'),
                'fecha_hasta' => Carbon::parse($this->reserva->fecha_hasta)->format('d/m/Y'),
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
