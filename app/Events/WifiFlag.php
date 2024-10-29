<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WifiFlag implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $data = [];

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data = [
            'Foo' => "bar",
            'Data'=>'marsupilami'
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('WifiFlag');
    }

    public function broadcastAs()
    {
        return 'WifiEvent';
    }

    /**
    * The event's broadcast name.
    *
    * @return string
    */
    public function broadcastWith()
    {
        return [
            'data' => $this->data
        ];
    }

}
