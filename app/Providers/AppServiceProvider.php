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
        $request->macro('urlSearchParams', function ($prepend = '&') use ($request) {
            return $prepend . http_build_query($request->only(SearchParams::KEYS));
        });

        $request->macro('searchParams', function ($key = null) use ($request) {
            if (in_array($key, SearchParams::KEYS)) {
                return SearchParams::$key($request);
            }

            if (is_null($key)) {
                return SearchParams::all($request);
            }
        });
    }
}
