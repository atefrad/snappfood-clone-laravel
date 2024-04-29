<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Discount\StoreDiscountRequest;
use App\Models\Discount;
use Illuminate\Http\RedirectResponse;

class DiscountController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $discounts = Discount::query()
            ->paginate(Controller::DEFAULT_PAGINATE);

        return view('admin.discount.index', compact('discounts'));
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.discount.create');
    }

    public function store(StoreDiscountRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $discount = Discount::query()->create($validated);

        return redirect()->route('admin.discount.index')
            ->with('toast-success', __('response.discount_store_success'));
    }

    public function destroy(Discount $discount): RedirectResponse
    {
        $discount->delete();

        return redirect()->route('admin.discount.index')
            ->with('toast-success', __('response.discount_delete_success'));
    }
}
