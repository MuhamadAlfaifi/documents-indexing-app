<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchTools
{
    public const NAMES = ['tag', 'user', 'hijd', 'hijm', 'hijy', 'query', 'sort'];

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

    public function defaultYear()
    {
        return (int) Carbon::now()->toHijri()->format('Y');
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
    
    public function hijd() 
    {
        return (int) $this->request->query('hijd');
    }
    
    public function hijm() 
    {
        return (int) $this->request->query('hijm');
    }
    
    public function hijy() 
    {
        if ($this->request->missing('hijy')) {
            return $this->defaultYear();
        }
        
        return (int) $this->request->query('hijy');
    }

    public function sort() 
    {
        if ($this->request->missing('sort')) {
            return ['updated_at', 'desc'];
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