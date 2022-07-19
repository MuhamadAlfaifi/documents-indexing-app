<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchParams
{
    public const NAMES = ['tag', 'user', 'date', 'query', 'sort'];
    public const OLDEST_CREATED_AT_VALUE = '2022-07-17 17:17:25';
    
    public static function oldest()
    {
        return Carbon::create(self::OLDEST_CREATED_AT_VALUE);
    }

    public static function query(Request $request)
    {
        if ($request->missing('query')) {
            return '';
        }

        return '%' . $request->query('query') . '%';
    }
    
    public static function tag(Request $request) 
    {
        return $request->query('tag');
    }
    
    public static function user(Request $request) 
    {
        return $request->query('user');
    }
    
    public static function date(Request $request) 
    {
        return [now()->subWeek(), now()];
    }

    public static function sort(Request $request) 
    {
        if ($request->missing('sort')) {
            return ['created_at', 'desc'];
        }

        return explode(',', $request->query('sort'));
    }
}