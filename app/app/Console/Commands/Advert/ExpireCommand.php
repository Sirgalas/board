<?php

namespace App\Console\Commands\Advert;

use App\Entity\Adverts\Advert\Advert;
use App\UseCases\Adverts\AdvertService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireCommand extends Command
{
    protected $signature = 'advert:expire';

    private $service;

    protected $description = 'Command description';


    public function __construct(AdvertService $service)
    {
        parent::__construct();
        $this->service=$service;
    }


    public function handle()
    {
        $success=true;
        foreach (Advert::active()->where('expire_at','<',Carbon::now())->cursor() as $advert){
            try{
                $this->service->expire($advert);
            }catch (\DomainException $e){
                $this->error($e->getMessage());
                $success=false;
            }
        }
        return $success;
    }
}
