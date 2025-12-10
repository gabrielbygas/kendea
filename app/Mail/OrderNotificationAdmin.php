<?php
// Modified by Claude

namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderNotificationAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;
    public $client;
    public $activities;

    /**
     * Create a new message instance.
     */
    public function __construct(Commande $commande, $client, $activities)
    {
        $this->commande = $commande;
        $this->client = $client;
        $this->activities = $activities;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle commande reçue - Dubai Activities #' . $this->commande->id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order-notification-admin',
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
