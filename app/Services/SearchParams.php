<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class SearchParams
{
    public const KEYS = ['tag', 'user', 'date', 'q'];

    public static function q(Request $request)
    {
        return $request->query('q');
    }
    
    public static function tag(Request $request) {
        $all = Tag::get('id')->map(fn ($x) => $x->id)->toArray();
        
        if ($request->missing('tag')) {
            return $all;
        }
        
        return $request->get('tag');
    }
    
    public static function user(Request $request) {
        $all = Tag::get('id')->map(fn ($x) => $x->id)->toArray();
    
        if ($request->missing('user')) {
            return $all;
        }
        
        return $request->get('user');
    }

    public static function all(Request $request)
    {
        return collect(self::KEYS)->flatMap(function ($key) use ($request) {
            $item = $request->query($key, []); // $item type could be str or arr

            if (!is_array($item)) {
                $item = [$item];
            }

            return $item;
        })->toArray();
    }
}