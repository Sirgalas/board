<?php

namespace App\UseCases\Auth;


use App\Entity\User\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Contracts\User as NetworkUser;

class NetworkService
{
    public function auth(string $network, NetworkUser $data): User
    {
        if ($user = User::byNetwork($network, $data->getId())->first()) {
            return $user;
        }

        if ($data->getEmail() && $user = User::where('email', $data->getEmail())->exists()) {
            throw new \DomainException('User with this email is already registered.');
        }

        $user = DB::transaction(function () use ($network, $data) {
            return User::registerByNetwork($network, $data->getId());
        });

        event(new Registered($user));

        return $user;
    }
    public function attach($id, string $network, NetworkUser $data): User
    {
        if ($user = User::byNetwork($network, $data->getId())->where('id','<>',$id)->exists()) {
            throw new \DomainException('Пользователь уже зарегистрирован в системе');
        }

        if ($user = User::byNetwork($network,$data->getId())->first()) {
            throw new \DomainException('User with this email is already registered.');
        }

        $user= User::findOrFail($id);
        $user->attachNetwork($network,$data->getId());

        return $user;
    }
}