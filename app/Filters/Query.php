<?php

namespace App\Filters;

class Query extends Filter
{
    public function apply($builder)
    {
        if (request()->filled('query')) {
            $builder
                ->where('title', 'like', request()->filterable('query'))
                ->orWhere('topic', 'like', request()->filterable('query'));
        }
    }
}