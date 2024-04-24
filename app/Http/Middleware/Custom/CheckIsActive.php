<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $seller = auth('seller')->user();

        if(!$seller->restaurant)
        {
            return redirect()->route('seller.restaurant.create')
                ->with('toast-error', __('response.restaurant_isActive_error'));
        }
        if(!$seller->restaurant->isActive)
        {
            return redirect()->route('seller.restaurant.show', $seller->restaurant)
                ->with('toast-error', __('response.restaurant_isActive_error'));;
        }

        return $next($request);
    }
}
