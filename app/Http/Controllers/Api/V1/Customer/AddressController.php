<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Customer\Address\StoreAddressRequest;
use App\Http\Resources\V1\Customer\AddressResource;
use App\Models\Address;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    public function index()
    {
        $customerId = Auth::guard('customer')->id();

        $addresses = Address::query()->filterCustomer()->get();

        return AddressResource::collection($addresses);
    }

    public function store(StoreAddressRequest $request): JsonResponse
    {
        /** @var Address $address */

        $validated = $request->validated();

        $address = Address::query()->create($validated);

        $address->customers()->attach($validated['customer_id']);

        return response()->json([
            'message' => __('response.address_store_success')
        ], Response::HTTP_OK);
    }

    public function setCurrent(Address $address): JsonResponse
    {
        /** @var Customer $customer */
        $customer =  Auth::guard('customer')->user();

        $oldCurrentAddressId = $customer->currentAddress->id;

        if($oldCurrentAddressId != $address->id)
        {
            $customer->addresses()
                ->updateExistingPivot($oldCurrentAddressId, ['current_address' => false]);

            $customer->addresses()
                ->updateExistingPivot($address->id, ['current_address' => true]);
        }

        return response()->json([
            'message' => __('response.address_setCurrent_success')
        ], Response::HTTP_OK);
    }
}
