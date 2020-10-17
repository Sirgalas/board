<?php

namespace App\Providers;

use App\Services\Banner\CostCalculator;
use Illuminate\Support\ServiceProvider;
use App\Services\Sms\SmsRu;
use App\Services\Sms\SmsSender;
use Illuminate\Contracts\Foundation\Application;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //
    }

    public function register()
    {
        $this->app->singleton(CostCalculator::class, function (Application $app) {
            $config = $app->make('config')->get('banner');
            return new CostCalculator($config['price']);
        });
        Passport::ignoreMigrations();
    }
}
