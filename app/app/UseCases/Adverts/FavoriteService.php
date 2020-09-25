<?php


namespace App\UseCases\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\User;

class FavoriteService
{
    public function add(string $userId,Advert $advert):void
    {
        $user = $this->getUser($userId);
        $user->addToFavorites($advert->id);
    }

    public function remove(string $userId,Advert $advert):void
    {
        $user=$this->getUser($userId);
        $user->removeFromFavorites($advert->id);
    }

    private function getUser(string $userId):User
    {
        return User::findOrFail($userId);
    }
}