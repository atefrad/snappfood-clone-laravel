<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;


class SellerLoginController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('seller.auth.login');
    }

    public function store()
    {

    }


}
