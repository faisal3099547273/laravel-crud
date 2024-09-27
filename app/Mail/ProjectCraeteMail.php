<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Project;

class ProjectCraeteMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $project;
    /**
     * Create a new message instance.
     */
    public function __construct($project)
    {
        //
        $this->project = $project;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Project Craete',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $project = Project::where('id',$this->project)->first();
        return new Content(
            view: 'mail.notification_mail',
            with:['project' => $project]
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
