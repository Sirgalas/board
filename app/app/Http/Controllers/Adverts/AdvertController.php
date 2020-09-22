<?php

namespace App\Http\Controllers\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Http\Controllers\Controller;
use App\Http\Router\AdvertsPath;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Auth;

class AdvertController extends Controller
{
    public function index(AdvertsPath $path)
    {
        $query = Advert::active()->with(['category', 'region'])->orderByDesc('published_at');

        if ($category = $path->category) {
            $query->forCategory($category);
        }

        if ($region = $path->region) {
            $query->forRegion($region);
        }

        $regions = $region
            ? $region->children()->orderBy('name')->getModels()
            : Region::roots()->orderBy('name')->getModels();

        $categories = $category
            ? $category->children()->defaultOrder()->getModels()
            : Category::whereIsRoot()->defaultOrder()->getModels();

        $adverts = $query->paginate(20);

        return view('adverts.index', compact('category', 'region', 'categories', 'regions', 'adverts'));
    }

    public function show(Advert $advert)
    {
        $this->isAllowShow($advert);
        $user = Auth::user();
        return view('adverts.show', compact('advert','user'));
    }

    public function phone(Advert $advert): string
    {
        $this->isAllowShow($advert);
        return $advert->user->phone;
    }

    private function isAllowShow(Advert $advert):void
    {
        if(!($advert->isActive() || Gate::allows('show-advert', $advert))){
            abort(403);
        }
    }
}
