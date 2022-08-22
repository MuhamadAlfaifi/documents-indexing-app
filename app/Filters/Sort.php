<?php

namespace App\Filters;

use Closure;

class Sort extends Filter
{
    public function apply($builder)
    {
        $builder->orderBy(...request()->filterable('sort'));
    }
}