<?php

namespace App\Http\Controllers\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCases\Adverts\FavoriteService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class FavoriteController extends Controller
{
    private $service;

    public function __construct(FavoriteService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    public function add(Advert  $advert)
    {
        try{
            $this->service->add(Auth::id(),$advert);
        }catch (\DomainException $e){
            return back()->with('error',$e->getMessage());
        }
        return redirect()->route('adverts.show',$advert)->with('success','Добавлено в избранное');
    }

    public function remove(Advert $advert)
    {
        try {
            $this->service->remove(Auth::id(),$advert);
        }catch (\DomainException $e) {
            return back()->with('error',$e->getMessage());
        }
        return redirect()->route('adverts.show',$advert);
    }
}
