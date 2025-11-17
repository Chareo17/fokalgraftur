<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use App\Models\Undangan;

class UndanganCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $undangan;

    /**
     * Create a new event instance.
     */
    public function __construct(Undangan $undangan)
    {
        $this->undangan = $undangan;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('undangan-channel'),
        ];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'id' => $this->undangan->id,
            'judul' => $this->undangan->judul,
            'deskripsi' => Str::limit($this->undangan->deskripsi, 100),
            'gambar' => $this->undangan->gambar,
            'role_target' => $this->undangan->role_target,
            'created_at' => $this->undangan->created_at->toISOString(),
            'name' => $this->undangan->name ?? 'Admin',
            'download_url' => route('undangan.download-pdf', $this->undangan->id),
        ];
    }
}
