<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Services\SearchParams;

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
        \Request::macro('searchable', function ($key = null) use ($request) {
            if (in_array($key, SearchParams::NAMES)) {
                return SearchParams::$key($request);
            }
        });
        
        \Request::macro('searchParams', function () use ($request) {
            return $request->only(SearchParams::NAMES);
        });
        
        \Request::macro('blankParams', function () use ($request) {
            return collect($request->only(SearchParams::NAMES))->flatten()->every(fn ($param) => blank($param));
        });

        \Illuminate\Support\Stringable::macro('if', function (bool $boolean) {
            if ($boolean) {
                return (string) new static($this->value);
            }
            
            return '';
        });
    }
}
