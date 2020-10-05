<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Banner\Banner;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Http\Requests\Banner\EditRequest;
use App\Http\Requests\Banner\RejectRequest;
use App\Http\Search\Admin\BannerSearch;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public $search;
    private $service;

    public function __construct(BannerSearch $search)
    {
        $this->search=$search;
    }

    public function index(BannerRequest $request)
    {
        $banners = $this->search->search($request);
        $statuses = Banner::$statusesList;
        return view('admin.banners.index', compact('banners', 'statuses'));
    }

    public function show(Banner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    public function editForm(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function edit(EditRequest  $request, Banner $banner)
    {
        try{
            $this->service->editByAdmin($banner->id,$request);
        }catch (\DomainException $e){
            return back()->with('error',$e->getMessage());
        }
        return redirect()->route('admin.banners.show', $banner);
    }

    public function moderate(Banner $banner)
    {
        try {
            $this->service->moderate($banner->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.banners.show', $banner);
    }

    public function reject(RejectRequest $request, Banner $banner)
    {
        try {
            $this->service->reject($banner->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.banners.show', $banner);
    }

    public function pay(Banner $banner)
    {
        try {
            $this->service->pay($banner->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.banners.show', $banner);
    }

    public function destroy(Banner $banner)
    {
        try {
            $this->service->removeByAdmin($banner->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.banners.index');
    }
}
