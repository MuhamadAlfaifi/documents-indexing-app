<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\SearchTools;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->blank()) {
            return to_route('posts.index');
        }

        $posts = $this->filterPosts($request);
        $tags = \App\Models\Tag::all();
        $users = \App\Models\User::all();

        return view('posts.index', compact('posts', 'users', 'tags'));
    }
    
    private function filterPosts(Request $request)
    {
        $postsQuery = Post::query()->with('tags')->with('user');

        if ($request->filled('query')) {
            $postsQuery->where('title', 'like', $request->filterable('query'));
        }
        
        if ($request->filled('tag')) {
            $postsQuery->whereBelongsTo('tags', fn ($query) => 
                $query->whereIn('id', $request->filterable('tag'))
            );
        }
        
        if ($request->filled('user')) {
            $postsQuery->whereIn('user_id', $request->filterable('user'));
        }
        
        if ($request->filled('from')) {
            $postsQuery->where('created_at', '>=', $request->filterable('from'));
        }
        
        if ($request->filled('to')) {
            $postsQuery->where('created_at', '=<', $request->filterable('to'));
        }
        
        return $postsQuery->orderBy(...$request->filterable('sort'))->paginate(10)->appends($request->query());
    }
}
