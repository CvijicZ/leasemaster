<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth', ['section' => 'login']);
    }

    public function showRegistration()
    {
        return view('auth', ['section' => 'register']);
    }

    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }

    public function store(CreateUserRequest $request)
    {

        $validatedData = $request->validated();

        try {
            User::create($validatedData);

            return redirect()->route('login')
                ->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return response()->redirectToRoute('register')
                ->withErrors(['error' => 'An error occurred while creating the user. Please try again.']);
        }
    }
}
