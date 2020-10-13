<?php

namespace Tests\Unit\Entity\User;

use App\Entity\User\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RoleTest extends TestCase
{
    public function testChange(): void
    {
        $user = factory(User::class)->create(['role' => User::ROLE_USER]);

        self::assertFalse($user->isAdmin());

        $user->changeRole(User::ROLE_ADMIN);

        self::assertTrue($user->isAdmin());
    }

    public function testAlready(): void
    {
        $user = factory(User::class)->create(['role' => User::ROLE_ADMIN]);
        $this->expectExceptionMessage('Роль присвоена.');
        $user->changeRole(User::ROLE_ADMIN);
    }
}