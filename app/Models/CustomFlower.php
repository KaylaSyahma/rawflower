<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomFlower extends Model
{
    use HasFactory;

    protected $table = 'custom_flowers';

    protected $fillable = [
        'nama',
        'image',
        'deskripsi',
        'harga',
        'available'
    ];
}
