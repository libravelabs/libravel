<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PageSettings extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'page_settings';
    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'boolean',
    ];
}
