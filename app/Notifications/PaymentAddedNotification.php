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
    protected $isUpdate; // New parameter

    /**
     * Create a new notification instance.
     *
     * @param string $userName
     * @param float $paymentAmount
     * @param string $paydataName
     * @param int $paymentId
     * @param bool $isUpdate
     */
    public function __construct($userName, $paymentAmount, $paydataName, $paymentId = null, $isUpdate = false)
    {
        $this->userName = $userName;
        $this->paymentAmount = $paymentAmount;
        $this->paydataName = $paydataName;
        $this->paymentId = $paymentId;
        $this->isUpdate = $isUpdate;
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
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $action = $this->isUpdate ? 'updated' : 'added';

        return [
            'message' => "{$this->userName} has {$action} a payment of {$this->paymentAmount} for {$this->paydataName}.",
            'payment_amount' => $this->paymentAmount,
            'paydata_name' => $this->paydataName,
            'payment_id' => $this->paymentId,
            'time' => now()->toDateTimeString(),
        ];
    }
}

