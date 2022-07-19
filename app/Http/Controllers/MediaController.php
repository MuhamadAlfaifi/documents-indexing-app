<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MediaPath;

class MediaController extends Controller
{
    /**
     * Handles media files
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $mediaPath = $request->file('media')->store(MediaPath::NAME);

        $filename = (string) str($mediaPath)->afterLast('/');

        return redirect(route('posts.create', [ MediaPath::NAME => $filename ]));
    }
}