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
        if ($request->blankParams()) {
            return to_route('posts.index');
        }

        $posts = $this->searchPosts($request);
        $tags = \App\Models\Tag::all();
        $users = \App\Models\User::all();

        return view('posts.index', compact('posts', 'users', 'tags'));
    }
    
    private function searchPosts(Request $request)
    {
        $postsQuery = Post::query()->with('tag')->with('user');

        if ($request->has('query')) {
            $postsQuery->where('title', 'like', $request->searchable('query'));
        }
        
        if ($request->has('tag')) {
            $postsQuery->whereIn('tag_id', $request->searchable('tag'));
        }
        
        if ($request->has('user')) {
            $postsQuery->whereIn('user_id', $request->searchable('user'));
        }
        
        if ($request->has('date')) {
            $postsQuery->whereBetween('created_at', $request->searchable('date'));
        }
        
        return $postsQuery->orderBy(...$request->searchable('sort'))->paginate(10)->appends($request->query());
    }
}
