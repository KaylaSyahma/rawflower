<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|lowercase|email|unique:users',
            'password' => ['required', Rules\Password::defaults()],
        ]);

        // Enkripsi password
        $validated['password'] = Hash::make($validated['password']);

        // Buat user baru
        $user = User::create($validated);

        // Buat token dari Laravel Sanctum
        $token = $user->createToken('api_token')->plainTextToken;

        // Kirim response ke frontend (frontend bisa simpan token)
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }
}
