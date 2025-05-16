<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExpireInactiveToken
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->currentAccessToken()) {
            $lastUsed = $user->currentAccessToken()->last_used_at;

            if ($lastUsed && Carbon::parse($lastUsed)->diffInMinutes(now()) > 30) {
                $user->currentAccessToken()->delete();
                return response()->json(['message' => 'Session expired'], 401);
            }

            $user->currentAccessToken()->forceFill(['last_used_at' => now()])->save();
        }

        return $next($request);
    }
}
