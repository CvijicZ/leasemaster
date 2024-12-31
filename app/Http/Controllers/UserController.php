<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.dashboard', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $validated = $request->validated();

        if (!$request->filled('password')) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
    }
}
