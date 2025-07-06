<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = strtolower(trim(Auth::user()->role));
        $roles = array_map('strtolower', array_map('trim', $roles));
        // Jika role kosong, izinkan semua role (fallback)
        if (empty($roles) || in_array($userRole, $roles)) {
            return $next($request);
        }

        // Untuk debug, bisa tambahkan log jika perlu
        abort(403, 'Unauthorized.');
      }

}