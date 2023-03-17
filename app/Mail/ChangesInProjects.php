<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ChangesInProjects extends Mailable
{
    use Queueable, SerializesModels;

    private $project;
    private $changes_type;


    /**
     * Create a new message instance.
     */
    public function __construct(Project $project, $changes_type)
    {
        $this->project = $project;
        $this->changes_type = $changes_type;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Changes In Projects',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $project = $this->project;
        $changes_type = $this->changes_type;
        $url = env('APP_HOST_FRONTEND') . "/projects/$project->id";
        return new Content(
            view: 'emails.projects.changes',
            with: compact('project', 'url', 'changes_type'),
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
