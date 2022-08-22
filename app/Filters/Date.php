<?php

namespace App\Filters;

use Closure;

class Date extends Filter
{
    public function apply($builder)
    {
        if (request()->filled('from')) {
            $builder->where('created_at', '>=', request()->filterable('from'));
        }
        
        if (request()->filled('to')) {
            $builder->where('created_at', '=<', request()->filterable('to'));
        }
    }
}