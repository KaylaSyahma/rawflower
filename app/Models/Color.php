<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';

    protected $fillable = [
        'name',
        'slug',
        'image'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    protected static function booted()
{
    static::deleting(function ($color) {
        if ($color->image && Storage::disk('public')->exists($color->image)) {
            Storage::disk('public')->delete($color->image);
        }
    });
}
}
