<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Customer\Profile\UpdateCustomerProfileRequest;
use App\Http\Resources\V1\Customer\ProfileResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    public function update(UpdateCustomerProfileRequest $request)
    {
        $customer = $request->user('customer');

        $customer->update($request->validated());

        return response()->json([
            'message' => __('response.profile_update_success'),
            'data' => ProfileResource::make($customer)
        ], Response::HTTP_OK);
    }
}
