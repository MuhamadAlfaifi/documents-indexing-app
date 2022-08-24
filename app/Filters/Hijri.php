<?php

namespace App\Filters;

class Hijri extends Filter
{
    public function apply($builder)
    {
        if (request()->filled('hijd')) {
            $builder->where('hijri_day', '=', request()->filterable('hijd'));
        }
        
        if (request()->filled('hijm')) {
            $builder->where('hijri_month', '=', request()->filterable('hijm'));
        }
        
        if (request()->filled('hijy')) {
            $builder->where('hijri_year', '=', request()->filterable('hijy'));
        }
    }
}