<?php

namespace App\Console\Commands\Banner;

use App\Entity\Banner\Banner;
use Illuminate\Console\Command;
use Predis\Client;
use Illuminate\Support\Facades\Mail;

class ExpireCommand extends Command
{

    protected $signature = 'banner:expire';

    private $client;

    protected $description = 'Command description';

    public function __construct(Client $client)
    {
        parent::__construct();
        $this->client=$client;
    }

    public function handle()
    {
        $success=true;

        foreach (Banner::active()->whereRaw('`limit` - views < 100')->cursor() as $banner){
            /** @var $banner Banner */
            $key = 'banner_notify_' . $banner->id;
            if($this->client->get($key)){
                continue;
            }
            Mail::to($banner->user->email)->queue(new BannerExpiresSoonMail($banner));
            $this->client->set($key, true);
        }

        return $success;
    }
}
