<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomAdditional extends Model
{
    use HasFactory;

    protected $table = 'custom_additionals';

    protected $fillable = [
        'nama',
        'image',
        'harga',
        'available'
    ];
}
