<?php

namespace App\Listener\Adverts;

use App\Events\Adverts\Create;
use App\Services\Search\AdvertIndexer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateListener
{
    private $indexer;

    /**
     * IndexerListener constructor.
     * @param AdvertIndexer $indexer
     */
    public function __construct(AdvertIndexer $indexer)
    {
        $this->indexer=$indexer;
    }

    /**
     * Handle the event.
     *
     * @param  Create  $event
     * @return void
     */
    public function handle(Create $event)
    {
        $this->indexer->index($event->advert);
    }
}
