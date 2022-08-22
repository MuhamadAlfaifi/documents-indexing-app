<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\SearchTools;
use Illuminate\Pipeline\Pipeline;

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
        $builder = Post::query()->with('tags')->with('user');

        $results = app(Pipeline::class)
            ->send($builder)
            ->through([
                \App\Filters\Query::class,
                \App\Filters\Tag::class,
                \App\Filters\User::class,
                \App\Filters\Date::class,
                \App\Filters\Sort::class,
            ])
            ->thenReturn();
        
        return $results->paginate(10)->appends($request->query());
    }
}
