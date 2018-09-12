<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FeedbackNotification extends Notification
{
    use Queueable;
    protected $feedback_info;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($feedback_info)
    {
        $this->feedback_info = $feedback_info;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Обратная связь с сайта')
                    ->line('Имя:    ' . $this->feedback_info['name'])
                    ->line('Телефон:    ' . $this->feedback_info['phone'])
                    ->line('Email:    ' . $this->feedback_info['email']);

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
