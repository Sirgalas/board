<?php

namespace App\Http\Controllers;

use App\Entity\Banner\Banner;
use App\Http\Requests\Banner\GetRequest;
use App\UseCases\Banner\BannerService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    private $service;

    public function __construct(BannerService $service)
    {
        $this->service = $service;
    }

    public function get(GetRequest $request)
    {
        if (!$banner = $this->service->getRandomForView($request->category, $request->region, $request->format)) {
            return '';
        }
        return view('banner.get', compact('banner'));
    }

    public function click(Banner $banner)
    {
        $this->service->click($banner);
        return redirect($banner->url);
    }
}
