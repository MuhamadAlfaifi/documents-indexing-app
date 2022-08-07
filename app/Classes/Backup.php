<?php

namespace App\Classes;

use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class Backup
{
    public $filename;
    public $size;
    public $created_at;

    /**
     * Create a new instance
     * 
     * @param $filename string
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->size = filesize(
            storage_path(
                join('/', ['app', 'public', Config::get('backup.backup.name'), $filename])
            )
        );
        $this->created_at = Carbon::createFromTimestamp(filemtime(
            storage_path(
                join('/', ['app', 'public', Config::get('backup.backup.name'), $filename])
            )
        ))->setTimezone('Asia/Riyadh');
    }

    public function sizeForHumans($unit = 'MB') {
        if( (!$unit && $this->size >= 1<<30) || $unit == 'GB')
            return number_format($this->size/(1<<30),2).'GB';
        if( (!$unit && $this->size >= 1<<20) || $unit == 'MB')
            return number_format($this->size/(1<<20),2).'MB';
        if( (!$unit && $this->size >= 1<<10) || $unit == 'KB')
            return number_format($this->size/(1<<10),2).'KB';
        
        return number_format($this->size).' bytes';
    }

    public function url()
    {
        return '/' . join('/', ['storage', Config::get('backup.backup.name'), $this->filename]);
    }
}