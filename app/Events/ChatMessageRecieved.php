<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageRecieved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $message;
    protected $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat');
    }

    public function broadcastWith(){
        return [
            'message' => $this->request['message'],
            'send' => $this->request['send'],
            'receive' => $this->request['receive'],
            'job_id' => $this->request['job_id']
        ];
    }
    public function broadcastAs(){
        return 'chat_event';
    }
}
