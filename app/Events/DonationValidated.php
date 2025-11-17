<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Donasi;

class DonationValidated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $donation;

    /**
     * Create a new event instance.
     *
     * @param Donasi $donation
     * @return void
     */
    public function __construct(Donasi $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        // Broadcast on a private channel specific to the donor user ID
        return new \Illuminate\Broadcasting\PrivateChannel('donations.' . $this->donation->user_id);
    }

    public function broadcastAs()
    {
        return 'DonationValidated';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->donation->id,
            'name' => $this->donation->nama,
            'nominal' => $this->donation->nominal,
            'updated_at' => $this->donation->updated_at->toDateTimeString(),
        ];
    }
}
