<?php


namespace App\UseCases\Auth;


use App\Entity\User\User;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\Auth\VerifyMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

class RegisterService
{

    private $mailer;
    private $dispatcher;

    public function __construct(Mailer $mailer, Dispatcher $dispatcher)
    {
        $this->mailer=$mailer;
        $this->dispatcher=$dispatcher;
    }


    public function create(RegisterRequest $request ):void
    {
        $user=User::register($request);
        $this->mailer->to($user->email)->send(new VerifyMail($user));
        $this->dispatcher->dispatch(new Registered($user));
    }

    public function verify($id):void
    {
        $user=User::findOrFail($id);
        $user->verify();
    }
}