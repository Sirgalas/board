<?php


namespace App\Providers;


use App\Entity\Adverts\Category;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Entity\Region;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CacheServiceProvider
 * @package App\Providers
 * @property array $classes
 */

class CacheServiceProvider extends ServiceProvider
{
    private $classes = [
        Region::class,
        Category::class
    ];

    public function boot(): void
    {
        foreach ($this->classes as $class) {
            $this->registerFlusher($class);
        }
    }

    private function registerFlusher($class): void
    {
        $flush = function() use ($class) {
            Cache::tags($class)->flush();
        };

        /** @var Model $class */
        $class::created($flush);
        $class::saved($flush);
        $class::updated($flush);
        $class::deleted($flush);
    }
}