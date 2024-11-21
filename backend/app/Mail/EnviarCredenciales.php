<?php

namespace App\Mail;

use App\Models\Cliente;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;

use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnviarCredenciales extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected Cliente $cliente,
        protected $password
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
            subject: 'Envío de Credenciales Jumping',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $frontendUrl = env('FRONTEND_URL', 'http://localhost:3000');
        return new Content(
            view: 'mail.reservas.credenciales',
            with: [
                'pathToImage' => 'images/jumping-logo.png',
                'nombre' => "{$this->cliente->apellido}, {$this->cliente->nombre}",
                'email' => $this->cliente->email,
                'password' => $this->password,
                'frontendUrl' => "{$frontendUrl}/login"
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