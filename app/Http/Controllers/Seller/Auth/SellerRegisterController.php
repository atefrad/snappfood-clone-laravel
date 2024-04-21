<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\RegisterRequest;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerRegisterController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        Auth::guard('seller')->logout();

        return view('seller.auth.register');
    }

    public function store(RegisterRequest $request)
    {
        /** @var Seller $seller */

        $validated = $request->validated();

        $seller = Seller::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password'])
        ]);

        Auth::guard('seller')->login($seller);

        return redirect()->route('seller.restaurant-profile.create');

    }
}
