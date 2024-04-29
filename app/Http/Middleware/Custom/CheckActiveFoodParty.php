<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveFoodParty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->route('food')->activeFoodParty)
        {
            return redirect()->route('seller.food.index')
                ->with('toast-error', __('response.food_party_exists'));
        }
        return $next($request);
    }
}
