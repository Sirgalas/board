<?php

namespace App\Events\Adverts;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Entity\Adverts\Advert\Advert;

/**
 * Class Indexer
 * @package App\Events\Adverts
 * @property Advert $advert
 */
class Create
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $adverts;

    /**
     * Indexer constructor.
     * @param Advert $advert
     */
    public function __construct(Advert $advert)
    {
        $this->adverts=$advert;
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
