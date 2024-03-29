<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use Spatie\PdfToText\Pdf as FileKeywordsSuggestions;
use App\Services\MediaPath;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

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
        $currentHijriYear = (int) Carbon::now()->toHijri()->format('Y');

        $posts = Post::with('tags')->where('hijri_year', '=', $currentHijriYear)->orderBy(...request()->filterable('sort'))->paginate(10);
        $tags = Tag::all();
        $users = User::all()->except(1);

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

        $suggestedKeywords = $this->getKeywordsSuggestions(MediaPath::getUploadedFile($request));

        return view('posts.create', compact('suggestedKeywords', 'tags'));
    }

    private function getKeywordsSuggestions($file)
    {
        try {
            $parts = pathinfo($file);

            if ($parts['extension'] !== 'pdf') {
                return '';
            }

            return FileKeywordsSuggestions::getText($file);
        } catch (\Exception $error) {
            return '';
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreatePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $validated = $this->validateForm($request);

        $validated['user_id'] = auth()->user()->id;

        $post = \DB::transaction(function () use ($validated, $request) {
            $post = Post::create($validated);
    
            $post->tags()->attach($validated['tag_id']);
                    
            $post->seizeMedia(
                MediaPath::getUploadedFile($request, false)
            );

            return $post;
        });
        

        return redirect(route('posts.show', ['post' => $post->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $tags = Tag::all();

        return view('posts.show', compact('post', 'tags'));
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
        $validated = $this->validateForm($request);
        
        \DB::transaction(function () use ($post, $validated) {
            $post->update($validated);

            $post->tags()->sync([$validated['tag_id']]);
        });

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

    private function validateForm($request)
    {
        return $request->validate([
            'title' => 'required|string|min:3',
            'no' => 'required|numeric',
            'tag_id' => 'required|integer|exists:App\Models\Tag,id',
            'topic' => 'required|string',
            'keywords' => 'required|string',
            'hijri' => 'array|required',
            'hijri.0' => 'required|numeric|digits_between:1,2|max:31|min:0',
            'hijri.1' => 'required|numeric|digits_between:1,2|max:12|min:0',
            'hijri.2' => 'required|numeric|digits:4',
        ]);
    }
}
