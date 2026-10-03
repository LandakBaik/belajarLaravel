<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        
        if ($request->user()?->role !== $role) {
            return response()->json(['message' => 'Akses ditolak!'], 403);
        }

        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        Log::info('Request selesai', ['url' => $request->fullUrl()]);
    }

}
