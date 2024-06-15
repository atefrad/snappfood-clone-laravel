<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Customer\Address\SetCurrentAddressRequest;
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
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $addresses = Address::query()
            ->filterCustomer()
            ->paginate(Controller::DEFAULT_PAGINATE);

        return AddressResource::collection($addresses);
    }

    public function store(StoreAddressRequest $request): JsonResponse
    {
        /** @var Address $address */

        $validated = $request->validated();

        $address = Address::query()->create($validated);

        $address->customers()->attach($validated['customer_id']);

        return response()->json([
            'message' => __('response.address_store_success'),
            'data' => AddressResource::make($address)
        ], Response::HTTP_OK);
    }

    public function setCurrent(SetCurrentAddressRequest $request,Address $address): JsonResponse
    {
        $validated = $request->validated();

        if($validated['old_current_address_id'])
        {
            $validated['customer']->addresses()
                ->updateExistingPivot($validated['old_current_address_id'], ['current_address' => false]);
        }

        $validated['customer']->addresses()
            ->updateExistingPivot($address->id, ['current_address' => true]);


        return response()->json([
            'message' => __('response.address_setCurrent_success'),
            'data' => AddressResource::make($address)
        ], Response::HTTP_OK);
    }
}
