<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Services\SearchTools;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(SearchTools::class);

        // flattens query string parameters into a list of [kev,val] pairs
        \Illuminate\Support\Collection::macro('pairs', function () {
            return $this->flatMap(function ($value, $key) {
                if (is_array($value)) {
                    return array_map(fn ($item) => [$key, $item], $value);
                }

                return [[$key, $value]];
            });
        });

        \Illuminate\Support\Facades\Request::macro('tools', function () {
            return app(SearchTools::class);
        });

        \Illuminate\Support\Facades\Request::macro('filterable', function ($key = null) {
            if (in_array($key, SearchTools::NAMES)) {
                return app(SearchTools::class)->{$key}();
            }
        });
        
        \Illuminate\Support\Facades\Request::macro('filters', function () {
            return collect($this->only(SearchTools::NAMES))
                ->filter(fn ($param) => filled($param))
                ->pairs()
                ->map(function ($pair) {
                    $unfilter = app(SearchTools::class)->regenerateUrl($pair);
                    
                    return [ ...$pair, $unfilter ];
                })
                ->toArray();
        });
        
        \Illuminate\Support\Facades\Request::macro('blank', function () {
            return collect($this->only(SearchTools::NAMES))->flatten()->every(fn ($param) => blank($param));
        });

        \Illuminate\Support\Stringable::macro('if', function (bool $boolean) {
            if ($boolean) {
                return $this->value;
            }
            
            return '';
        });
    }
}
