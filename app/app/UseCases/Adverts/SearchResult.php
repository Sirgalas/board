<?php


namespace App\UseCases\Adverts;

use Illuminate\Contracts\Pagination\Paginator;

/**
 * Class SearchResult
 * @package App\UseCases\Adverts
 * @property Paginator $adverts
 * @property array $regionsCounts
 * @property array $categoriesCounts
 */
class SearchResult
{
    public $adverts;
    public $regionsCounts;
    public $categoriesCounts;

    public function __construct(Paginator $adverts, array $regionsCounts, array $categoriesCounts)
    {
        $this->adverts = $adverts;
        $this->regionsCounts = $regionsCounts;
        $this->categoriesCounts = $categoriesCounts;
    }


}