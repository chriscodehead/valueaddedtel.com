<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    private $name;
    private $email;
    private $code;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $email, $code)
    {
        //
        $this->name = $name;
        $this->email = $email;
        $this->code = $code;
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
    { //'. env('APP_NAME'). '
        return (new MailMessage)
            ->greeting('Hello ' . $this->name)
            ->line('Your account on Xtrarvalue Added Telecom is almost created completely!')
            ->line('Your verification code is '.$this->code)
            ->line('The verification expires in 30 minutes')
            ->line('Accept Jesus Christ today as your Lord and Personal Savior.')
            ->line('Thank you for using Xtrarvalue Added Telecom'); //. env('APP_NAME')
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
