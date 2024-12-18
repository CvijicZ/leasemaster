<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;

class AuthController extends Controller
{
    private const VIEW_SECTIONS = ['login', 'register'];

    public function show($section)
    {
        if (!in_array($section, self::VIEW_SECTIONS)) {
            abort(404);
        }

        return view('auth', ['section' => $section]);
    }

    public function store(CreateUserRequest $request)
    {

        $validatedData = $request->validated();

        try {
            $user = new User($validatedData);
            $user->save();

            return redirect()->route('auth.show', ['section' => 'login'])
                ->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return response()->redirectToRoute('auth.show', ['section' => 'register'])
                ->withErrors(['error' => 'An error occurred while creating the user. Please try again.']);
        }
    }
}
