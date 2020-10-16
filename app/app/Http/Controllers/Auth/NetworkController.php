<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\UseCases\Auth\NetworkService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class NetworkController extends Controller
{
    private $service;

    public function __construct(NetworkService $service)
    {
        $this->service = $service;
    }

    public function redirect(string $network)
    {
        return Socialite::driver($network)->redirect();
    }

    public function callback(string $network)
    {
        $data = Socialite::driver($network)->user();

        try {
            if(Auth::check()){
                $this->service->attach(Auth::id(),$network,$data);
            }else{
                $user = $this->service->auth($network, $data);
                Auth::login($user);
            }
            return redirect()->intended();
        } catch (\DomainException $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }
}
