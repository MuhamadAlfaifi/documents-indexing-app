<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchTools
{
    public const NAMES = ['tag', 'user', 'from', 'to', 'query', 'sort'];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function min()
    {
        $zero = cache()->rememberForever('zero', function() {
            $zero = User::orderBy('created_at', 'asc')->first();

            if (!$zero) {
                return now()->timestamp;
            }

            return $zero->created_at->timestamp;
        });

        return Carbon::createFromTimestamp($zero);
    }

    public function max()
    {
        return now();
    }

    public function query()
    {
        if ($this->request->missing('query')) {
            return '';
        }

        return '%' . $this->request->query('query') . '%';
    }
    
    public function tag() 
    {
        return $this->request->query('tag');
    }
    
    public function user() 
    {
        return $this->request->query('user');
    }
    
    public function from() 
    {
        return Carbon::create($this->request->query('from'));
    }
    
    public function to() 
    {
        return Carbon::create($this->request->query('to'));
    }

    public function sort() 
    {
        if ($this->request->missing('sort')) {
            return ['created_at', 'desc'];
        }

        return explode(',', $this->request->query('sort'));
    }

    public function regenerateUrl($pair)
    {
        [$key, $value] = $pair;
        
        $query = $this->request->query();
        
        if (is_array($query[$key])) {                
            $query[$key] = array_filter($query[$key], fn ($x) => $x !== $value);
        } else {
            $query = \Arr::except($query, $key);
        }
        
        return url()->current() . '?' . \Arr::query($query);
    }
}