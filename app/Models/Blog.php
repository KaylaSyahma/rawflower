<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'image',
        'judul',
        'isi',
        'slug',
        'excerpt',
        'published_at',
    ];

    protected static function booted()
    {
        static::creating(function ($blog) {
            $blog->slug = Str::slug($blog->judul);
            $blog->excerpt = Str::limit(strip_tags($blog->isi), 150);
            $blog->published_at = now();
        });

        static::updating(function ($blog) {
            if ($blog->isDirty('judul')) {
                $blog->slug = Str::slug($blog->judul);
            }

            if ($blog->isDirty('isi')) {
                $blog->excerpt = Str::limit(strip_tags($blog->isi), 150);
            }
        });
    }

    // accessor untuk image
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
