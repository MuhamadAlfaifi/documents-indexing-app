<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $mediaPath = $request->file('media')->store('tmp');

        $filename = str_replace('tmp/', '', $mediaPath);

        return redirect(route('posts.create', [ 'tmp' => $filename ]));
    }
}
