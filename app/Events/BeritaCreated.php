<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BeritaCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $berita;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Berita  $berita
     * @return void
     */
    public function __construct(\App\Models\Berita $berita)
    {
        $this->berita = $berita;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('berita-channel');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->berita->id,
            'judul' => $this->berita->judul,
            'name' => $this->berita->name,
            'created_at' => $this->berita->created_at->toDateTimeString(),
        ];
    }
}
