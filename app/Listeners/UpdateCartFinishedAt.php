<?php

namespace App\Listeners;

use App\Events\CartPayed;

class UpdateCartFinishedAt
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
    public function handle(CartPayed $event): void
    {
        $event->cart->update([
            'finished_at' => now()
        ]);
    }
}
