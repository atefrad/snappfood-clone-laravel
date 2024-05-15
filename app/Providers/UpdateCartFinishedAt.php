<?php

namespace App\Providers;

use App\Providers\CartPayed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
