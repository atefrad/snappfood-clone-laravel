<?php

namespace App\Http\Controllers\Api\V1\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Customer\Auth\RegisterRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request): JsonResponse
    {
        /** @var Customer $customer */

        $validated = $request->validated();

        $customer = Customer::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password'])
        ]);

        return response()->json([
            'token' => $customer->generateToken()
        ], Response::HTTP_OK);
    }
}
