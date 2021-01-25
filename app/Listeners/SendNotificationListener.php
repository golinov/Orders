<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Notifications\ProductsOrdered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationListener implements ShouldQueue
{
    use InteractsWithQueue;

    private $to;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->to = config('mail.to');
    }

    /**
     * Handle the event.
     *
     * @param OrderCreated $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $order = $event->order;
        Notification::route('mail', $this->to)
            ->notify(new ProductsOrdered($order));
        Notification::send($event->order, new ProductsOrdered($order));
    }
}
