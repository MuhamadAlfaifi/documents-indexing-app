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
        $backupsPath = storage_path(
            join('/', ['app', 'public', Config::get('backup.backup.name')])
        );

        $filenames = array_diff(scandir($backupsPath), ['.', '..']);

        $backups = collect([]);

        foreach ($filenames as $filename) {
            $backups->push(new \App\Classes\Backup($filename));
        }

        $backups = $backups->sortByDesc(fn ($x) => $x->created_at->timestamp);

        $latest = $backups->first();

        return view('backups.index', compact('backups', 'latest'));
    }
}
