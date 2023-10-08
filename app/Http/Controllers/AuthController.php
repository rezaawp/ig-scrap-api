<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    function halamanLoginMasyarkat() {
        return view('pages.login-masyarakat');
    }
}
