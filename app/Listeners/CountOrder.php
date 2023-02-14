<?php

namespace App\Listeners;

use App\Events\NewOrderEvent;
use App\Order;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class CountOrder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewOrderEvent $event)
    {
        Log::info('Nova order criada, com ID ' . $event->order->id . ' pelo usuário ' . $event->order->seller->name);
    }
}