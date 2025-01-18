<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckEditUserAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->route('user');

        if (is_string($user) || is_numeric($user)) { // TODO: find a better way for this, I wanted to enable param 'user' to be user object or user id
            $user = User::findOrFail($user);
        }

        $authUser = Auth::user();

        if ($authUser->id === $user->id || $authUser->is_admin) {
            return $next($request);
        }

        return redirect()->route('home')
            ->with('error', 'You are not authorized to edit this user.');
    }
}
