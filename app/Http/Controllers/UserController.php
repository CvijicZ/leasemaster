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

        return view('user.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function edit(User $user)
    {
        $user->profilePicture = $user->profilePicture()->value('path');

        return view('user.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, int $userId)
    {
        $validated = $request->validated();
        $user = User::findOrFail($userId);

        if (!$request->filled('password')) {
            unset($validated['password']);
        }

        $user->update($validated);

        return back()->with('success', 'User updated successfully.');
    }

    public function updateRole(User $user)
    {

        $user->update(['is_admin' => !$user->is_admin]);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }
}
