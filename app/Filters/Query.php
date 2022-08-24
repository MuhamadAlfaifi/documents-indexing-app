<?php

namespace App\Filters;

class Query extends Filter
{
    public function apply($builder)
    {
        $value = request()->query('query');
        
        if (empty($value)) {
            return;
        }

        if (is_numeric($value)) {
            $builder->where('no', '=', (int) $value);
        } else {
            $builder
                ->where('title', 'like', "%$value%")
                ->orWhere('topic', 'like', "%$value%");
        }
    }
}