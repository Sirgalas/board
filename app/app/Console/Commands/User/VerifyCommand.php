<?php

namespace App\Console\Commands\User;

use App\UseCases\Auth\RegisterService;
use App\Entity\User;
use Illuminate\Console\Command;

class VerifyCommand extends Command
{

    public $service;

    public function __construct(RegisterService $service)
    {
        parent::__construct();
        $this->service=$service;
    }

    protected $signature = 'user:verify {email}';

    protected $description = 'Верифицируем пользователя';

    public function handle():bool
    {
       $email= $this->argument('email');
       if(!$user=User::where('email',$email)->first()){
           $this->error('Не найден пользователь с email '.$email);
           return false;
       }
       try{
           $this->service->verify($user->id);
       }catch (\DomainException $e){
           $this->error($e->getMessage());
           return false;
       }

       $this->info('Пользователь верифицирован');
       return true;
    }
}
