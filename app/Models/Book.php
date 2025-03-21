<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Book extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Searchable;

    protected $table;
    protected $fillable = ['id', 'title', 'slug', 'synopsis', 'language', 'image_path', 'page_count', 'release_date', 'is_fiction', 'is_education', 'is_teachers_book'];

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            DB::transaction(function () use ($model) {
                $lastBook = Book::lockForUpdate()->latest('id')->first();

                if (!$lastBook) {
                    $nextId = 1;
                } else {
                    $lastNumber = (int) substr($lastBook->id, 2);
                    $nextId = $lastNumber + 1;
                }

                $model->id = 'lb' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
            });
        });

        static::saving(function ($book) {
            if (!$book->slug) {
                $slug = \Illuminate\Support\Str::slug($book->title);

                $originalSlug = $slug;
                $counter = 1;
                while (Book::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }

                $book->slug = $slug;
            }
        });
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre', 'book_id', 'genre_id');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_author');
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'book_collections');
    }

    public function whoSaved()
    {
        return $this->belongsToMany(User::class, 'read_laters', 'book_id', 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(UserReview::class);
    }

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }

    public function getMediaBasePath(Media $media): string
    {
        return 'books';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('books')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif']);

        $this->addMediaCollection('book.documents')
            ->singleFile()
            ->acceptsMimeTypes(['application/pdf']);
    }

    public function getCoverPath($type = 'single')
    {
        $spatieUrl = $this->getFirstMedia('books') ? $this->getFirstMedia('books')->getUrl() : null;
        $imagePath = $this->image_path;

        if ($type === 'all') {
            return [
                'spatie' => $spatieUrl,
                'image_path' => $imagePath
            ];
        }

        return $spatieUrl ?: $imagePath;
    }


    public function registerAllMediaConversions(): void
    {
        $this->addMediaConversion('webp')
            ->width(100)
            ->height(100);
    }

    public function scopeHasDocument($query)
    {
        return $query->whereHas('media', function ($mediaQuery) {
            $mediaQuery->where('collection_name', 'documents');
        });
    }

    public function scopeDoesntHaveDocument($query)
    {
        return $query->whereDoesntHave('media', function ($mediaQuery) {
            $mediaQuery->where('collection_name', 'documents');
        });
    }

    public function scopeTrending(Builder $query, $days = null)
    {
        return $query->withCount([
            'downloads' => function ($q) use ($days) {
                if ($days) {
                    $q->where('created_at', '>=', now()->subDays($days));
                }
            },
            'reviews' => function ($q) use ($days) {
                if ($days) {
                    $q->where('created_at', '>=', now()->subDays($days));
                }
            },
            'whoSaved as read_later_count' => function ($q) use ($days) {
                if ($days) {
                    $q->where('read_laters.created_at', '>=', now()->subDays($days));
                }
            }
        ])
            ->havingRaw('(downloads_count + reviews_count + read_later_count) > 0') // Hanya buku yang punya aktivitas
            ->orderByDesc(DB::raw('(downloads_count + reviews_count + read_later_count)'));
    }

    public function toSearchableArray()
    {
        return [
            'id'   => $this->id,
            'title' => $this->title,
            'synopsis' => $this->synopsis,
        ];
    }
}
