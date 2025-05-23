<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryFlower extends Model
{
    use HasFactory;
    protected $table = 'category_flowers';

    protected $fillable = [
        'nama'
    ];

    public function flowers(){
        return $this->hasMany(CustomFlower::class, 'category_flower_id');
    }
}
