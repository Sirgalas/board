<?php

namespace App\Http\Controllers;

use App\Entity\Banner\Banner;
use App\Http\Requests\Payment\PaymentRequest;
use App\UseCases\Banner\BannerService;
use App\UseCases\Payment\PaymentInterface;
use App\UseCases\Payment\Payments;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class PaymentController
 * @package App\Http\Controllers
 * @property PaymentInterface $classes
 */
class PaymentController extends Controller
{
    private $config;
    private $classes;

    public function __construct()
    {
        $this->config = app('config')->get('payment');
        $this->classes=Payments::$paymentClass[$this->config['class']];
    }

    public function result(PaymentRequest $request)
    {
        if (!$this->classes->payments($request,$this->config)) {
            return 'bad sign';
        }

        $banner = Banner::findOrFail($request->InvId);
        $banner->pay(Carbon::now());

        return 'OK' . $request->InvId;
    }

    public function success(Request $request)
    {

    }

    public function fail(Request $request)
    {

    }
}
