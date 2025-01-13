<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Contract;
use Illuminate\Support\Facades\Auth;

class EnsureContractOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        $contractId = $request->route('id');

        $contract = Contract::find($contractId);

        if (!$contract) {
            abort(404, 'Contract not found.');
        }

        if ($contract->user_id !== Auth::user()->id) {
            abort(403, 'You do not have permission to access this contract.');
        }

        return $next($request);
    }
}
