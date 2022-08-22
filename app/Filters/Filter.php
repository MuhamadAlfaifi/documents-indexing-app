<?php

namespace App\Filters;

use Closure;

abstract class Filter
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);
        
        $this->apply($builder);

        return $builder;
    }
}