<?php


namespace App\Http\Controllers\Cabinet\Adverts;


use App\Http\Controllers\Controller;
use App\Http\Middleware\FilledProfile;
use Illuminate\Support\Facades\Auth;
use App\Entity\Adverts\Advert\Advert;

class AdvertController extends Controller
{
    public function __construct()
    {
        $this->middleware('filled');
    }

    public function index()
    {
        $adverts = Advert::forUser(Auth::user())->orderByDesc('id')->paginate(20);

        return view('cabinet.adverts.index', compact('adverts'));
    }
}