<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommentDeleteRequestRejected extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private string $sellerName;
    private string $deleteRequestReason;

    /**
     * Create a new message instance.
     */
    public function __construct(string $sellerName, string $deleteRequestReason)
    {
        $this->sellerName = $sellerName;

        $this->deleteRequestReason = $deleteRequestReason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Comment Delete Request Rejected',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.comment.delete-request.rejected',
            with: [
                'sellerName' => $this->sellerName,
                'deleteRequestReason' => $this->deleteRequestReason,
                'url' => route('seller.comment.index')
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
