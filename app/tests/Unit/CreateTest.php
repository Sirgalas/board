<?php

namespace Tests\Unit;

use App\Entity\User\User;
use App\Http\Requests\Admin\Users\CreateRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function create():void
    {
        $name='name';
        $email='email';
        $request= $this->createMock(CreateRequest::class);
        $request->name=$name;
        $request->email=$email;
        $user=User::new($request);

        self::assertNotEmpty($user);
        self::assertEquals($name,$user->name);
        self::assertEquals($email,$user->email);
        self::assertNotEmpty($user->password);
        self::assertTrue($user->isActive());
    }
}
