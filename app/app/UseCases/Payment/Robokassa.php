<?php


namespace App\UseCases\Payment;


use App\Entity\Banner\Banner;
use App\Http\Requests\Payment\PaymentRequest;
use App\Services\Sms\SmsSender;
use Illuminate\Contracts\Foundation\Application;

class Robokassa implements PaymentInterface
{
    public $config;

    public function __construct(){
        $this->config=app('config')->get('payment');
    }

    public function generateRedirectUrl(Banner $banner,bool $test,string $shpItem):string
    {
        if($this->config['local']){
            return url('payment.result');
        }

            $login = $this->config['login'];
            $password1 = $this->config['pass1'];
            $invId = $banner->id;
            $outSum = $banner->cost;
            $signature = md5("$login:$outSum:$invId:$password1:Shp_item=$shpItem");
            $query = http_build_query([
                'Merchantlogin' => $login,
                'InvId' => $invId,
                'OutSum' => $outSum,
                'Shp_item' => 'banner',
                'Desc' => 'Banner',
                'Encoding' => 'utf-8',
                'IsTest' => $test ? 1 : 0,
                'SignatureValue' => $signature
            ]);
            return $this->config['url'] . $query;
    }

    public function payments(PaymentRequest $request):bool
    {
        if($this->config['local']){
            return true;
        }
        $password2 = $this->config['pass2'];

        $crc = strtoupper($request->SignatureValue);

        $my_crc = strtoupper(md5("$request->OutSum:$request->InvId:$password2:Shp_item=$request->Shp_item"));

        if ($my_crc !== $crc) {
            return false;
        }
        return true;
    }
}