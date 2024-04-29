<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FoodParty\UpdateFoodPartyRequest;
use App\Models\FoodParty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FoodPartyController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $foodParties = FoodParty::query()
            ->paginate(Controller::DEFAULT_PAGINATE);

        return view('admin.food-party.index', compact('foodParties'));
    }

    public function edit(FoodParty $foodParty): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.food-party.edit', compact('foodParty'));
    }

    public function update(UpdateFoodPartyRequest $request, FoodParty $foodParty): RedirectResponse
    {
        $validated = $request->validated();

        $foodParty->update($validated);

        return redirect()->route('admin.food-party.index')
            ->with('toast-success', __('response.food_party_update_success'));
    }
}
