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

        $posts = $this->applyFilters()->paginate(10)->appends($request->query());
        $tags = \App\Models\Tag::all();
        $users = \App\Models\User::all();

        return view('posts.index', compact('posts', 'users', 'tags'));
    }
    
    private function applyFilters()
    {
        $builder = Post::query()->with('tags')->with('user');

        return app(Pipeline::class)
            ->send($builder)
            ->through([
                \App\Filters\Query::class,
                \App\Filters\Tag::class,
                \App\Filters\User::class,
                \App\Filters\Date::class,
                \App\Filters\Hijri::class,
                \App\Filters\Sort::class,
            ])
            ->thenReturn();
    }
}
