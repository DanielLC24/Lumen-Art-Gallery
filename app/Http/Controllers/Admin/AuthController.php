<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private const USERNAME = 'admin';

    private const PASSWORD_HASH = '$2y$10$l1ZcbaNpR/uP6n1rJ/5isu.N/Aur23KTzqlLSJlDCizrGHdh2lVYS';

    public function showLogin()
    {
        if (session('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($credentials['username'] !== self::USERNAME || ! Hash::check($credentials['password'], self::PASSWORD_HASH)) {
            return back()
                ->withErrors(['username' => 'Usuario o contraseña incorrectos.'])
                ->onlyInput('username');
        }

        $request->session()->regenerate();
        $request->session()->put('admin_authenticated', true);

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_authenticated');
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('status', 'Sesion cerrada correctamente.');
    }
}
