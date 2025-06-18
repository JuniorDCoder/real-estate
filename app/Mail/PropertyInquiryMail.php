<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Property;

class PropertyInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $contactData;
    public $property;

    public function __construct($contactData, Property $property)
    {
        $this->contactData = $contactData;
        $this->property = $property;
    }

    /**
     * Get the message envelope.
     */
     public function envelope(): Envelope
    {
        return new Envelope(
            from: env('MAIL_FROM_ADDRESS', 'noreply@example.com'),
            subject: 'Property Inquiry - ' . $this->property->title .'-' . env('APP_NAME'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.property-inquiry',
            with: [
               'name' => $this->contactData['name'],
                'email' => $this->contactData['email'],
                'phone' => $this->contactData['phone'],
                'messageContent' => $this->contactData['message'],
                'property' => $this->property,
                'submittedAt' => now()->format('F j, Y \a\t g:i A'),
            ],
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
