<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Customer\Address\StoreAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    public function store(StoreAddressRequest $request)
    {
        /** @var Address $address */

        $validated = $request->validated();

        $address = Address::query()->create($validated);

        $address->customers()->attach($validated['customer_id']);

        return response()->json([
            'message' => __('response.address_store_success')
        ], Response::HTTP_OK);
    }
}
