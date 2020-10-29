<?php

namespace App\Console\Commands\Api;

use Illuminate\Console\Command;

class DocCommand extends Command
{

    protected $signature = 'api:doc';


    protected $description = 'Command add  openapi json doc';
    public function handle()
    {
        $swagger = base_path('/vendor/bin/openapi');
        $source = app_path('Http');
        $target = public_path('docs/swagger.json');

        passthru('"' . PHP_BINARY . '"' . " \"{$swagger}\" \"{$source}\" --output \"{$target}\"");
    }
}
