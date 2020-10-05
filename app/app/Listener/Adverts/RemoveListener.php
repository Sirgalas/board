<?php

namespace App\Listener\Adverts;

use App\Events\Adverts\Remove;
use App\Services\Search\AdvertIndexer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RemoveListener
{
    private $indexer;

    /**
     * RemoveListener constructor.
     * @param AdvertIndexer $indexer
     */
    public function __construct(AdvertIndexer $indexer)
    {
        $this->indexer=$indexer;
    }

    /**
     * Handle the event.
     *
     * @param  Remove  $event
     * @return void
     */
    public function handle(Remove $event)
    {
        $this->indexer->remove($event->advert);
    }
}
