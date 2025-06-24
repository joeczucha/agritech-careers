<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationMailer extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public Application $application) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('noreply@agritech.ie', 'Agritech Careers website'),
            subject: '[careers.agritech.ie] Application received',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application',
        );
    }

    public function attachments(): array
    {
        return collect($this->application->attachments)
            ->map(fn($path) => storage_path("app/public/{$path}"))
            ->filter(fn($fullPath) => file_exists($fullPath))
            ->toArray();
    }
}
