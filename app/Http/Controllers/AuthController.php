<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function halamanLoginPetugas()
    {
        return view('pages.login-petugas');
    }

    function halamanLoginMasyarkat()
    {
        return view('pages.login-masyarakat');
    }

    function prosesLoginMasyarakat(Request $request)
    {
        $login = Auth::guard('masyarakat')->attempt([
            'username' => $request->username,
            'password' => $request->password
        ]);

        if ($login) {
            return "login berhasil";
        }

        return "login gagal";
    }

    function prosesLoginPetugas(Request $request)
    {
        $login = Auth::guard('petugas')->attempt([
            'username' => $request->username,
            'password' => $request->password
        ]);

        if ($login) {
            return "login petugas berhasil";
        }

        return "login petugas gagal";
    }


    function logout()
    {
        $guards = config('auth.guards');

        $guardName = null;
        $logoutBerhasil = false;
        foreach ($guards as $guard => $values) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
                $logoutBerhasil = true;
                $guardName = $guard;
            }
        }

        if (!$logoutBerhasil) {
            return "anda belum login";
        }

        return redirect()->route('halamanlogin.' . $guardName);
    }
}
