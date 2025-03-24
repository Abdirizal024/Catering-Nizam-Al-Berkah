<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewOrderNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = [
            'id' => $order->id,
            'customer_name' => $order->customer_name,
            'total_price' => $order->total_price,
            'status' => $order->status,
        ];
    }

    public function broadcastOn()
    {
        return new Channel('orders');
    }


    public function broadcastAs()
    {
        return 'new-order';
    }
}