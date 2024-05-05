<?php

namespace App\Http\Controllers\Api\V1\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function store(LoginRequest $request): JsonResponse
    {
        /** @var Customer $customer */

        $validated = $request->validated();

        $customer = Customer::query()
            ->where('email', $validated['email'])
            ->first();

        if(!$customer || !Hash::check($validated['password'], $customer->password))
        {
            return response()->json([
                'message' => __('response.login_error')
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'token' => $customer->generateToken()
        ], Response::HTTP_OK);
    }
}
