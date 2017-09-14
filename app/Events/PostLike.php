<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class PostLike implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;
    public $message;
    public $postId;
    public $regId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($username, $postId, $regId)
    {
        $this->regId = $regId;
        $this->username = $username;
        $this->postId = $postId;
        $this->message  = "{$username} Liked your post.";
    }

    public function broadcastAs(){
        return 'new_like';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel(strval($this->regId));
    }
}
