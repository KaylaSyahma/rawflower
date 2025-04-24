<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomBow extends Model
{
    use HasFactory;

    protected $table = 'custom_bows';

    protected $fillable = [
        'nama',
        'image',
        'harga',
        'available'
    ];
}
