<?php

namespace App\Filters;

use Closure;

class User extends Filter
{
    public function apply($builder)
    {
        if (request()->filled('user')) {
            $builder->whereIn('user_id', request()->filterable('user'));
        }
    }
}