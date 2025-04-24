<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPaper extends Model
{
    use HasFactory;

    protected $table = 'custom_papers';

    protected $fillable = [
        'nama',
        'image',
        'harga',
        'available'
    ];
}
