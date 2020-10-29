<?php


namespace App\Http\Serializer;

use App\Entity\User\User;

class UserSerializer
{
    public function profile(User $user): array
    {
        return [
            'id' => $user->id,
            'email' => $user->email,
            'phone' => [
                'number' => $user->phone,
                'verified' => $user->phone_verified,
            ],
            'name' => [
                'first' => $user->name,
                'last' => $user->last_name,
            ],
        ];
    }
}