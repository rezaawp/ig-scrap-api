<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolePetugasMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($role) { // jika parameter role nya di isi
            $user =  Auth::guard('petugas');

            if (!$user->check()) { // jika user nya tidak login sebagai petugas
                $guards = config('auth.guards');
                $guardName = null;

                foreach ($guards as $guard => $values) {
                    if (Auth::guard($guard)->check()) { // melakukan pengecekan satu persatu apakah sudah ada yang login dari salah satu guard
                        $guardName = $guard;
                    }
                }

                if ($guardName) {
                    return abort(403);
                } else { // jika user tidak login sama sekali
                    return to_route('halamanlogin.masyarakat');
                }
            }

            if ($user->user()->level !== $role) { // jika user petugas memaksa masuk ke fitur admin dengan role petugas
                return abort(403);
            } else { //
                return $next($request);
            }
        } else {
            abort(500, 'Middleware error');
        }
    }
}
