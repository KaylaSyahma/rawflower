<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasName
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_as', // role user (0: user biasa, 1: admin)
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role_as' => 'integer', // biar role langsung dikonversi jadi integer
            'phone' => 'string'
        ];
    }

    /**
     * Relasi ke model Cart
     * Setiap user cuma punya satu cart aktif
     */
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * Cek apakah user adalah admin
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role_as == 1; // kalo role_as 1, berarti admin
    }

    /**
     * Untuk akses admin di Filament
     * @return bool
     */
    public function canAccessPanel($panel): bool
    {
        return $this->isAdmin(); // cuma admin yang bisa akses Filament
    }

    /**
     * Get name buat di Filament
     * @return string
     */
    public function getFilamentName(): string
    {
        return $this->name;
    }
}
