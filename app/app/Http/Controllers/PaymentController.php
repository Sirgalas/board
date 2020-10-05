<?php

namespace App\Http\Controllers;

use App\Entity\Banner\Banner;
use App\Http\Requests\Payment\PaymentRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function result(PaymentRequest $request)
    {
        $password2 = 'dsf234234da';

        $crc = strtoupper($request->SignatureValue);

        $my_crc = strtoupper(md5("$request->OutSum:$request->InvId:$password2:Shp_item=$request->Shp_item"));

        if ($my_crc !== $crc) {
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
