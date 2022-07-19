<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title', 'description', 'keywords', 'tag_id', 'user_id'
    ];

    public function tag() {
        return $this->belongsTo(Tag::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Creates thumbnails for media
     * 
     * @return void
     */
    public function registerMediaConversions(Media $media = null): void
    {       
        $this->addMediaConversion('thumbnail')
            ->width(368)
            ->height(232);
    }
}
