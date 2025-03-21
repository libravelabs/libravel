<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Banner extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'content',
        'image_path',
        'is_active',
        'href',
        'start_date',
        'end_date',
        'image_only'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'image_only' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function isImageOnly(): bool
    {
        return $this->image_only;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function getMediaBasePath(Media $media): string
    {
        return 'banners';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('banners')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif']);
    }

    public function registerAllMediaConversions(): void
    {
        $this->addMediaConversion('webp')
            ->singleFile();
    }

    public function getImagePath($type = 'single')
    {
        $spatieUrl = $this->getFirstMedia('banners') ? $this->getFirstMedia('banners')->getUrl() : null;
        $imagePath = $this->image_path;

        if ($type === 'all') {
            return [
                'spatie' => $spatieUrl,
                'image_path' => $imagePath
            ];
        }

        return $spatieUrl ?: $imagePath;
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('start_date')
                    ->orWhere('start_date', '<=', now())
                    ->where(function ($q2) {
                        $q2->whereNull('end_date')
                            ->orWhere('end_date', '>=', now());
                    });
            });
    }
}
