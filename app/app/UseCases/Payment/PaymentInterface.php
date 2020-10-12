<?php


namespace App\UseCases\Payment;


use App\Entity\Banner\Banner;
use App\Http\Requests\Payment\PaymentRequest;

interface PaymentInterface
{
    public function generateRedirectUrl(Banner $banner,bool $test,string $shpItem,array $config):string;

    public function payments(PaymentRequest $request,array $config):bool;
}