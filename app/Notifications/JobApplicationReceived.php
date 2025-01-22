<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use App\Models\JobsListing;

class JobApplicationReceived extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @param \App\Models\JobsListing $job
     */
    public function __construct(public JobsListing $job)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param object $notifiable
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast', 'database'];
    }

    /**
     *
     * @param object $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage())
    //         ->subject('New Job Application Received')
    //         ->greeting('Hello!')
    //         ->line('You have received a new application for the job: ' . $this->job->title)
    //         ->action('View Application', url('/company/show/' . $this->job->id))
    //         ->line('Thank you for using our application!');
    // }

    public function broadcastOn(): array
    {
        return [new PrivateChannel('job.' . $this->job->id)];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'job_id' => $this->job->id,
            'job_title' => $this->job->title,
            'message' => 'A new job application has been received for the job: ' . $this->job->title,
        ]);
    }

    /**
     * @param object $notifiable     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'job_id' => $this->job->id,
            'job_title' => $this->job->title,
            'message' => 'You have received a new application for the job: ' . $this->job->title,
        ];
    }
}
