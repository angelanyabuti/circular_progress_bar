<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRider extends Notification
{
    use Queueable;
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
                    ->line('Hooray! We are excited to have you get started.
Thank you for a successful sign-up!
Delivery Team also deserve Good Deals!
Redeem your Perks &amp; Positive Reviews for Deals!.')
            ->action('Confirm Link', $this->token)
            ->line('*********************************')
            ->line('Please save the KouponZetu App on your
homepage for ease of access by clicking on the three buttons
at the right-hand corner, then select Add to Home Screen')
            ->line('If you have any questions, just reply to this email – we’re always happy to help out.')
            ->line('For support related matters; support@kouponzetu.com or +254 719 600875.')
            ->line('Cheers')
            ->line('The Feel the Deals Team');
            ;
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
