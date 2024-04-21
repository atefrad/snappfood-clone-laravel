<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Seller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SellerLoginController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        Auth::guard('seller')->logout();

        return view('seller.auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        /** @var  Seller $seller */
        $validated = $request->validated();

        $seller = Seller::query()
            ->where('email', $validated['email'])
            ->first();

        if(!$seller || !Hash::check($validated['password'], $seller->password))
        {
            return back()->withErrors([
                'email' => __('response.login_error')
            ])->onlyInput('email');
        }

        Auth::guard('seller')->login($seller);

        return redirect()->route('seller.dashboard.orders.new-orders');
    }

    public function destroy(): RedirectResponse
    {
        Auth::guard('seller')->logout();

        return redirect()->route('seller.login.create');
    }
}
