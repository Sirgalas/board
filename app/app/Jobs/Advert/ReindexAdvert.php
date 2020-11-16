<?php

namespace App\Jobs\Advert;

use App\Entity\Adverts\Advert\Advert;
use App\Services\Search\AdvertIndexer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class ReindexAdvert
 * @package App\Jobs\Advert
 * @property Advert $advert
 */
class ReindexAdvert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $advert;
    public function __construct(Advert $advert)
    {
        $this->advert=$advert;
    }


    public function handle(AdvertIndexer $advertIndexer):void
    {
        $advertIndexer->index($this->advert);
    }
}
