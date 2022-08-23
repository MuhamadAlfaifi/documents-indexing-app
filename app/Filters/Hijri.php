<?php

namespace App\Filters;

class Hijri extends Filter
{
    public function apply($builder)
    {
        // if (request()->filled('hijri')) {
        //     $builder->where('title', 'like', request()->filterable('query'));
        // }
    }
}