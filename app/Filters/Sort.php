<?php

namespace App\Filters;

class Sort extends Filter
{
    public function apply($builder)
    {
        $builder->orderBy(...request()->filterable('sort'));
    }
}