<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SiteInfo extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['shortname', 'fullname', 'url', 'description', 'email', 'phone', 'is_default'];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->is_default) {
                SiteInfo::where('id', '!=', $model->id)->update(['is_default' => false]);
            } else {
                if (SiteInfo::where('is_default', true)->count() === 1 && $model->is_default) {
                    throw new \Exception("At least one site info must be set as default.");
                }
            }

            cache()->forget('site_info');
        });

        static::deleting(function ($model) {
            if (SiteInfo::count() === 1) {
                throw new \Exception("You cannot delete the only site info record.");
            }

            if ($model->is_default) {
                $newDefault = SiteInfo::where('id', '!=', $model->id)->first();
                if ($newDefault) {
                    $newDefault->update(['is_default' => true]);
                }
            }

            cache()->forget('site_info');
        });

        static::saved(function () {
            cache()->rememberForever('site_info', function () {
                return SiteInfo::where('is_default', true)->first() ?? SiteInfo::first();
            });
        });

        static::deleted(function () {
            cache()->rememberForever('site_info', function () {
                return SiteInfo::where('is_default', true)->first() ?? SiteInfo::first();
            });
        });
    }



    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile();
        $this->addMediaCollection('favicon')->singleFile();
    }

    public function getLogoUrlAttribute()
    {
        return $this->getFirstMediaUrl('logo') ?: asset('assets/libravel-logo.png');
    }

    public function getFaviconUrlAttribute()
    {
        return $this->getFirstMediaUrl('favicon') ?: asset('favicon.ico');
    }
}
