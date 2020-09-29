<?php

namespace App\Http\Controllers\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Http\Controllers\Controller;
use App\Http\Router\AdvertsPath;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Adverts\SearchRequest;
use App\ReadModel\AdvertReadRepository;
use App\UseCases\Adverts\SearchService;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    private $search;

    public function __construct(SearchService $search)
    {
        $this->search = $search;
    }

    public function index(SearchRequest $request, AdvertsPath $path)
    {
        $region = $path->region;
        $category = $path->category;

        $regions = $region
            ? $region->children()->orderBy('name')->getModels()
            : Region::roots()->orderBy('name')->getModels();

        $categories = $category
            ? $category->children()->defaultOrder()->getModels()
            : Category::whereIsRoot()->defaultOrder()->getModels();

        $adverts = $this->search->search($category, $region, $request, 20, $request->get('page', 1));

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
