<?php

namespace App\Notifications;

use App\Channels\UpdateDeliveryStatusSMSChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateDeliveryStatusSMS extends Notification
{
    use Queueable;
    public $delivery_status;
    public $order_id;
    public $deliveryMethod_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($orderId,$delivery_status,$deliveryMethod_id)
    {
        $this->delivery_status=$delivery_status;
        $this->order_id=$orderId;
        $this->deliveryMethod_id=$deliveryMethod_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [UpdateDeliveryStatusSMSChannel::class];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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

    public function toSms($notifiable)
    {
        return
        [
            $this->delivery_status,
            $this->order_id,
            $this->deliveryMethod_id,
        ];

    }
}
