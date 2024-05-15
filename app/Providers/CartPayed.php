<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CartPayed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Cart $cart;
    public Payment $payment;

    /**
     * Create a new event instance.
     */
    public function __construct(Cart $cart, Payment $payment)
    {
        $this->cart = $cart;
        $this->payment = $payment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
