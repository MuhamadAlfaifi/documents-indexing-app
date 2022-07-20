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
    public function boot(Request $request)
    {
        // flattens query string parameters into a list of [kev,val] pairs
        \Illuminate\Support\Collection::macro('pairs', function () {
            return $this->flatMap(function ($value, $key) {
                if (is_array($value)) {
                    return array_map(fn ($item) => [$key, $item], $value);
                }

                return [[$key, $value]];
            });
        });

        \Illuminate\Support\Facades\Request::macro('filterable', function ($key = null) use ($request) {
            if (in_array($key, SearchTools::NAMES)) {
                return SearchTools::$key($request);
            }
        });
        
        \Illuminate\Support\Facades\Request::macro('filters', function () use ($request) {
            return collect($request->only(SearchTools::NAMES))
                ->filter(fn ($param) => filled($param))
                ->pairs()
                ->map(function ($pair) use ($request) {
                    $unfilter = SearchTools::regenerateUrl($request, $pair);
                    
                    return [ ...$pair, $unfilter ];
                })
                ->toArray();
        });
        
        \Illuminate\Support\Facades\Request::macro('blank', function () use ($request) {
            return collect($request->only(SearchTools::NAMES))->flatten()->every(fn ($param) => blank($param));
        });

        \Illuminate\Support\Stringable::macro('if', function (bool $boolean) {
            if ($boolean) {
                return $this->value;
            }
            
            return '';
        });
    }
}
