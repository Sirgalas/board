<?php

namespace Tests\Unit;

use App\Entity\User;
use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * Class RegisterTest
 * @package Tests\Unit
 * @property string $name
 * @property string $email
 * @property string $password
 * @property RegisterRequest $request
 */
class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    private $name='name';
    private $email='email';
    private $password='password';
    private $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->request= $this->createMock(RegisterRequest::class);
        $this->request->name=$this->name;
        $this->request->email=$this->email;
        $this->request->password=$this->password;
    }

    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function create():void
    {
        $user=User::register($this->request);
        self::assertNotEmpty($user);
        self::assertEquals($this->name,$user->name);
        self::assertEquals($this->email,$user->email);
        self::assertNotEmpty($user->password);
        self::assertNotEquals($this->password,$user->password);
        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());
    }

    /**
     * @test
     */
    public function verify(): void
    {
        $user = User::register($this->request);
        $user->verify();
        self::assertFalse($user->isWait());
        self::assertTrue($user->isActive());
    }

    /**
     * @test
     */
    public function testAlreadyVerified(): void
    {
        $user = User::register($this->request);
        $user->verify();
        $this->expectExceptionMessage('User is already verified.');
        $user->verify();
    }
}
