<?php

namespace Banking\Events;

use Banking\Models\Transfer;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CardToCardEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Transfer $transfer;

    /**
     * Create a new event instance.
     */
    public function __construct(Transfer $transfer)
    {
        $this->transfer = $transfer;
    }

//    /**
//     * Get the channels the event should broadcast on.
//     *
//     * @return array<int, \Illuminate\Broadcasting\Channel>
//     */
//    public function broadcastOn(): array
//    {
//        return [
//            new PrivateChannel('channel-name'),
//        ];
//    }
}
