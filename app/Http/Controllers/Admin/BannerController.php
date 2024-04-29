<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banner\StoreBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $banners = Banner::query()
            ->paginate(Controller::DEFAULT_PAGINATE);

        return view('admin.banner.index', compact('banners'));
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.banner.create');
    }

    public function store(StoreBannerRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        $imagePath = $request
            ->file('image')
            ->store('/images/banner', 'public');

        $validated['image'] = "/storage/{$imagePath}";

        Banner::query()->create($validated);

        return redirect()->route('admin.banner.index')
            ->with('toast-success', __('response.banner_store_success'));
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();

        return redirect()->route('admin.banner.index')
            ->with('toast-success', __('response.banner_delete_success'));
    }
}
