<?php

namespace Tests\Unit\Entity\User;


use App\Entity\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PhoneTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function default(): void
    {
        $user = factory(User::class)->create([
            'phone' => null,
            'phone_verified' => false,
            'phone_verify_token' => null,
        ]);

        self::assertFalse($user->isPhoneVerified());
    }

    /**
     * @test
     */
    public function requestEmptyPhone(): void
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'phone' => null,
            'phone_verified' => false,
            'phone_verify_token' => null,
        ]);

        $this->expectExceptionMessage('Не указан номер телефона.');
        $user->requestPhoneVerification(Carbon::now());
    }

    /**
     * @test
     */
    public function request(): void
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'phone' => '79000000000',
            'phone_verified' => false,
            'phone_verify_token' => null,
        ]);

        $token = $user->requestPhoneVerification(Carbon::now());

        self::assertFalse($user->isPhoneVerified());
        self::assertNotEmpty($token);
    }

    /**
     * @test
     */
    public function requestWithOldPhone(): void
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'phone' => '79000000000',
            'phone_verified' => true,
            'phone_verify_token' => null,
        ]);

        self::assertTrue($user->isPhoneVerified());

        $user->requestPhoneVerification(Carbon::now());

        self::assertFalse($user->isPhoneVerified());
        self::assertNotEmpty($user->phone_verify_token);
    }

    /**
     * @test
     */
    public function requestAlreadySentTimeout(): void
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'phone' => '79000000000',
            'phone_verified' => true,
            'phone_verify_token' => null,
        ]);

        $user->requestPhoneVerification($now = Carbon::now());
        $user->requestPhoneVerification($now->copy()->addSeconds(User::PHONE_TOKEN_EXPIRE+200));

        self::assertFalse($user->isPhoneVerified());
    }

    /**
     * @test
     */
    public function requestAlreadySent(): void
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'phone' => '79000000000',
            'phone_verified' => true,
            'phone_verify_token' => null,
        ]);

        $user->requestPhoneVerification($now = Carbon::now());

        $this->expectExceptionMessage('Токен не создан');
        $user->requestPhoneVerification($now->copy()->addSeconds(User::PHONE_TOKEN_EXPIRE-200));
    }

    /**
     * @test
     */
    public function verify(): void
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'phone' => '79000000000',
            'phone_verified' => false,
            'phone_verify_token' => $token = 'token',
            'phone_verify_token_expire' => $now = Carbon::now(),
        ]);

        self::assertFalse($user->isPhoneVerified());

        $user->verifyPhone($token, $now->copy()->subSeconds(User::PHONE_TOKEN_EXPIRE-200));

        self::assertTrue($user->isPhoneVerified());
    }

    /**
     * @test
     */
    public function verifyIncorrectToken(): void
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'phone' => '79000000000',
            'phone_verified' => false,
            'phone_verify_token' => 'token',
            'phone_verify_token_expire' => $now = Carbon::now(),
        ]);

        $this->expectExceptionMessage('Не правильный токен.');
        $user->verifyPhone('other_token', $now->copy()->subSeconds(User::PHONE_TOKEN_EXPIRE-200));
    }

    /**
     * @test
     */
    public function verifyExpiredToken(): void
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'phone' => '79000000000',
            'phone_verified' => false,
            'phone_verify_token' => $token = 'token',
            'phone_verify_token_expire' => $now = Carbon::now(),
        ]);

        $this->expectExceptionMessage('Время ожидание ввода токена истекло.');
        $user->verifyPhone($token, $now->copy()->addSeconds(User::PHONE_TOKEN_EXPIRE+200));
    }
}
