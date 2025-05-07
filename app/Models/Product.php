<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'original_price',
        'quantity',
        'popular',
        'status'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function productImages() {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
   }

   public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function colors()
    {   // product punya banyak warna, nama pivot table, fk product_id, fk color_id
        return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id');
    }

    protected static function booted()
    {
        static::deleting(function ($product) {
            $product->load('productImages');

            foreach ($product->productImages as $image) {
                if ($image->image && Storage::disk('public')->exists($image->image)) {
                    Storage::disk('public')->delete($image->image);
                }

                $image->delete(); // hapus juga dari DB
            }
        });
    }
}
