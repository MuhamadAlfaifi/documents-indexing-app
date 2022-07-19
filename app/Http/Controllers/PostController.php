<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use Spatie\PdfToText\Pdf as FileKeywordsSuggestions;

class PostController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::orderBy(...$request->searchable('sort'))->paginate(10);
        $tags = Tag::all();
        $users = User::all();

        return view('posts.index', compact('posts','tags','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Http\Requests\CreatePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function create(CreatePostRequest $request)
    {
        $tags = Tag::all();

        $suggestedKeywords = $this->getKeywordsSuggestions($request->query('tmp'));

        return view('posts.create', compact('suggestedKeywords', 'tags'));
    }

    private function tmpPath($filename)
    {
        $tmpPath = storage_path('app/tmp');

        if (is_null($filename)) {
            return $tmpPath;
        }

        return join('/', [$tmpPath, $filename]);
    }

    private function getKeywordsSuggestions($filename)
    {
        $parts = pathinfo($filename);

        if ($parts['extension'] !== 'pdf') {
            return '';
        }

        return FileKeywordsSuggestions::getText($this->tmpPath($filename));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreatePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:3',
            'tag_id' => 'required|integer|exists:App\Models\Tag,id',
            'description' => 'string|nullable',
            'keywords' => 'string|nullable',
        ]);

        $validated['user_id'] = auth()->user()->id;
        
        $post = Post::create($validated);
        
        $pathToFile = '/tmp/' . $request->get('tmp');
        
        $post->addMediaFromDisk($pathToFile, 'local')->toMediaCollection();

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();

        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:3',
            'tag_id' => 'required|integer|exists:App\Models\Tag,id',
            'description' => 'string|nullable',
            'keywords' => 'string|nullable',
        ]);
        
        $post->updateOrFail($validated);

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect(\App\Providers\RouteServiceProvider::HOME);
    }
}
