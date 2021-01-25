<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductsOrdered extends Notification implements ShouldQueue
{
    use Queueable;

    private $order;

    /**
     * Create a new notification instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        if ($notifiable instanceof Order) {
            return (new MailMessage)
                ->line('Ordered products: ' . $this->order->products->implode('name', ', '))
                ->action('Go to site', url('/'))
                ->line('Thank you for using our service!');
        } else {
            $collection = collect($this->order);
            $addresses = $collection->filter(function ($value, $key) {
                return str_contains($key, 'shipping');
            })->values()->implode(', ');
            return (new MailMessage)
                ->line('Ordered products: ' . $this->order->products->implode('name', ', '))
                ->line('Shipping addresses: ' . $addresses)
                ->line('Visitor\'s email: ' . $this->order->email)
                ->action('Go to site', url('/'))
                ->line('Thank you for using our service!');
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
