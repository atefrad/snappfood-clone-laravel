<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\FoodParty\StoreFoodPartyRequest;
use App\Models\Food;
use App\Models\FoodParty;
use Illuminate\Http\RedirectResponse;

class FoodPartyController extends Controller
{
    public function create(Food $food): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        if($food->activeFoodParty)
        {
            return redirect()->route('seller.food.index')
                ->with('toast-error', __('response.food_party_exists'));
        }

        return view('seller.food-party.create', compact('food'));
    }

    public function store(StoreFoodPartyRequest $request, Food $food): RedirectResponse
    {
        if($food->activeFoodParty)
        {
            return redirect()->route('seller.food.index')
            ->with('toast-error', __('response.food_party_exists'));
        }

        $validated = $request->validated();

        FoodParty::query()->create($validated);

        return redirect()->route('seller.food.index')
            ->with('toast-success', __('response.food_party_create_success'));
    }

}
