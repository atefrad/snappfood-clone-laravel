<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        /** @var User $user */
        $validated = $request->validated();

        $user = User::query()
            ->where('email', $validated['email'])
            ->first();

        if(!$user || !Hash::check($validated['password'], $user->password))
        {
            return back()->withErrors([
                'email' => __('response.login_error')
            ])->onlyInput('email');
        }

        Auth::guard('admin')->login($user);

        return redirect()->route('admin.index');
    }

    public function destroy(): RedirectResponse
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login.create');
    }
}
