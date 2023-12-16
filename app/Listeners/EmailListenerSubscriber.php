<?php

namespace App\Listeners;

use App\Events\PurchaseEventSubscriber;
use App\Events\SignupEventSubscriber;
use App\Notifications\PurchaseNotification;
use App\Notifications\SignupNotification;
use Illuminate\Events\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmailListenerSubscriber
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handleSignupEvent(SignupEventSubscriber $event): void {
        $event->data->notify(new SignupNotification);
    }

    public function handlePurchaseEvent(PurchaseEventSubscriber $event): void {
        $event->data->notify(new PurchaseNotification);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @return array<string, string>
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            SignupEventSubscriber::class => 'handleSignupEvent',
            PurchaseEventSubscriber::class => 'handlePurchaseEvent',
        ];
    }
}




