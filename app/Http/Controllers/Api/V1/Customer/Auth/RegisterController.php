<?php

namespace App\Http\Controllers\Api\V1\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Customer\Auth\RegisterRequest;
use App\Http\Resources\V1\Customer\ProfileResource;
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
            'message' => __('response.register_success'),
            'token' => $customer->generateToken(),
            'data' => ProfileResource::make($customer)
        ], Response::HTTP_OK);
    }
}
