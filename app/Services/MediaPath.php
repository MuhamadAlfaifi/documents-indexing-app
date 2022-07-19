<?php

namespace App\Services;

use Illuminate\Http\Request;

class MediaPath
{
    public const NAME = 'tmp';

    public static function getUploadedFile(Request $request, bool $absolutePath = true)
    {
        $filename = $request->query(self::NAME);

        if (!$absolutePath) {
            return join('/', [self::NAME, $filename]);
        }
        
        return storage_path(
            join('/', ['app', self::NAME, $filename])
        );
    }
}