<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\SearchTools;
use Pharaonic\Hijri\HijriCarbon;
use \Illuminate\Support\Stringable;
use \Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\Request as RequestFacade;

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
        Schema::defaultStringLength(125);
        
        $this->app->singleton(SearchTools::class);

        // flattens query string parameters into a list of [kev,val] pairs
        Collection::macro('pairs', function () {
            return $this->flatMap(function ($value, $key) {
                if (is_array($value)) {
                    return array_map(fn ($item) => [$key, $item], $value);
                }

                return [[$key, $value]];
            });
        });

        RequestFacade::macro('tools', function () {
            return app(SearchTools::class);
        });

        RequestFacade::macro('filterable', function ($key = null) {
            if (in_array($key, SearchTools::NAMES)) {
                return app(SearchTools::class)->{$key}();
            }
        });
        
        RequestFacade::macro('filters', function () {
            return collect($this->only(SearchTools::NAMES))
                ->filter(fn ($param) => filled($param))
                ->pairs()
                ->map(function ($pair) {
                    $unfilter = app(SearchTools::class)->regenerateUrl($pair);
                    
                    return [ ...$pair, $unfilter ];
                })
                ->toArray();
        });
        
        RequestFacade::macro('blank', function () {
            return collect($this->only(SearchTools::NAMES))->flatten()->every(fn ($param) => blank($param));
        });

        Stringable::macro('if', function (bool $boolean) {
            if ($boolean) {
                return $this->value;
            }
            
            return '';
        });
        
        Carbon::mixin(HijriCarbon::class); 
    }
}
