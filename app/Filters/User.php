<?php

namespace App\Filters;

class User extends Filter
{
    public function apply($builder)
    {
        if (request()->filled('user')) {
            $builder->whereIn('user_id', request()->filterable('user'));
        }
    }
}