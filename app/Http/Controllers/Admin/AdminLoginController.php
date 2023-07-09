<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.admin.login');
    }

    public function login(Request $request)
    {
        // Validace přihlašovacích údajů
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Pokus o přihlášení správce
        if (auth()->guard('admin')->attempt($credentials)) {
            // Přihlášení proběhlo úspěšně
            return redirect('/admin/panel')->with('success', 'Přihlášení proběhlo úspěšně.');
        }

        // Přihlášení se nezdařilo
        return back()->withErrors(['email' => 'Neplatné přihlašovací údaje.'])->withInput();
    }
}
