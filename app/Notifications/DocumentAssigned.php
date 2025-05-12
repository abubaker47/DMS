<?php

namespace App\Notifications;

use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DocumentAssigned extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The document instance.
     *
     * @var \App\Models\Document
     */
    protected $document;

    /**
     * Create a new notification instance.
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = route('documents.show', $this->document);

        return (new MailMessage)
            ->subject(__('New Document Assigned'))
            ->line(__('A new document has been assigned to your department.'))
            ->line(__('Document: :name', ['name' => $this->document->original_file_name]))
            ->line(__('From: :department', ['department' => $this->document->fromDepartment->name]))
            ->action(__('View Document'), $url)
            ->line(__('Thank you for using our application!'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'document_id' => $this->document->id,
            'from_department' => $this->document->fromDepartment->name,
            'file_name' => $this->document->original_file_name,
            'message' => __('A new document has been assigned to your department.'),
        ];
    }
}
