<?php

namespace App\Filters;

use Closure;

class Tag extends Filter
{
    public function apply($builder)
    {
        if (request()->filled('tag')) {
            $builder->whereHas('tags', fn ($query) => 
                $query->whereIn('tag_id', request()->filterable('tag'))
            );
        }
    }
}