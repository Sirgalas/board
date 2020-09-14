<?php

namespace Tests\Unit\Entity\User;

use App\Entity\User;
use Tests\TestCase;


class PermissionTest extends TestCase
{
    public function testChange(): void
    {
        $user = factory(User::class)->create(['permission' => User::PERMISSION_USER]);
        /**
         * @var User $user
         */
        self::assertFalse($user->isExecutor());

        $user->changePermission(User::PERMISSION_EXECUTOR);

        self::assertTrue($user->isExecutor());
    }

    public function testAlready(): void
    {
        $user = factory(User::class)->create(['permission' => User::PERMISSION_EXECUTOR]);
        $this->expectExceptionMessage('Разрешение присвоено.');
        $user->changePermission(User::PERMISSION_EXECUTOR);
    }
}
