<?php

namespace App\Events\Adverts;

use App\Entity\Adverts\Advert\Advert;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class Remove
 * @package App\Events\Adverts
 * @property Advert $advert
 */
class Remove
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $advert;

    /**
     * Remove constructor.
     * @param Advert $advert
     */
    public function __construct(Advert $advert)
    {
        $this->advert=$advert;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
