<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public const TMP_DIRECTORY_NAME = 'tmp';

    /**
     * Handles media files
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $mediaPath = $request->file('media')->store(self::TMP_DIRECTORY_NAME);

        $filename = Str::of($mediaPath)->afterLast('/');

        return redirect(route('posts.create', [ self::TMP_DIRECTORY_NAME => $filename ]));
    }

    public static function getUploadedFile(Request $request)
    {
        $filename = $request->query(self::TMP_DIRECTORY_NAME);
        
        return storage_path(
            join('/', ['app', self::TMP_DIRECTORY_NAME, $filename])
        );
    }
}
