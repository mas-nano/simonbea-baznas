<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('pages.auth.login', ['type_menu' => 'auth']);
    }

    public function registerView()
    {
        return view("pages.auth.register", ['type_menu' => 'auth']);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $remember = false;
        if (isset($validated['remember'])) {
            $remember = true;
        }

        Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $remember);
        return redirect('/dashboard');
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]);

            Auth::login($user, $remember = true);

            return redirect('/dashboard');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
