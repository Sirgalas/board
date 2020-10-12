<?php


namespace App\UseCases\Payment;


use App\Entity\Banner\Banner;
use App\Http\Requests\Payment\PaymentRequest;

class Local implements PaymentInterface
{
    public function generateRedirectUrl(Banner $banner,bool $test,string $shpItem,array $config):string
    {
            return url('payment.result');
    }

    public function payments(PaymentRequest $request,array $config):bool
    {
        return true;
    }
}