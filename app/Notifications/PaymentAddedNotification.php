<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentAddedNotification extends Notification
{
    use Queueable;

    protected $userName;
    protected $paymentAmount;
    protected $paydataName;
    protected $paymentId;

    /**
     * Create a new notification instance.
     *
     * @param string $userName
     * @param float $paymentAmount
     * @param string $paydataName
     * @param int $paymentId
     */
    public function __construct($userName, $paymentAmount, $paydataName, $paymentId  = null)
    {
        $this->userName = $userName;
        $this->paymentAmount = $paymentAmount;
        $this->paydataName = $paydataName;
        $this->paymentId = $paymentId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => "{$this->userName} has " . ($this->paymentId ? 'updated' : 'added') . " a payment of {$this->paymentAmount} for {$this->paydataName}.",
            'payment_amount' => $this->paymentAmount,
            'paydata_name' => $this->paydataName,
            'payment_id' => $this->paymentId,
            'time' => now()->toDateTimeString(),
        ];
    }


}
