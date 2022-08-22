<?php

namespace App\Filters;

use Closure;

class Query extends Filter
{
    public function apply($builder)
    {
        if (request()->filled('query')) {
            $builder->where('title', 'like', request()->filterable('query'));
        }
    }
}