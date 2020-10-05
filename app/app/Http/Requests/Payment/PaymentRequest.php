<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PaymentRequest
 * @package App\Http\Requests\Payment
 * @property int $OutSum
 * @property int $InvId
 * @property string $Shp_item
 * @property string $SignatureValue
 */
class PaymentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'OutSum'=>'integer',
            'InvId'=>'integer',
            'Shp_item'=>'string',
            'SignatureValue'=>'string'
        ];
    }
}
