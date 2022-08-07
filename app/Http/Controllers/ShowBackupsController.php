<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ShowBackupsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $backupsPath = $this->getBackupsDir();

        $filenames = array_diff(scandir($backupsPath), ['.', '..']);

        $backups = collect([]);

        foreach ($filenames as $filename) {
            $backups->push(new \App\Classes\Backup($filename));
        }

        $backups = $backups->sortByDesc(fn ($x) => $x->created_at->timestamp);

        $latest = $backups->first();

        return view('backups.index', compact('backups', 'latest'));
    }

    private function getBackupsDir()
    {
        $path = storage_path(
            join('/', ['app', Config::get('backup.extra.dirname'), Config::get('backup.backup.name')])
        );

        if (!file_exists($path)) {
            mkdir($path);
        }

        return $path;
    }
}
