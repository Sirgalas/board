<?php

namespace App\Http\Requests\Cabinet;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PhoneVerifyPhoneRequest
 * @package App\Http\Requests\Cabinet
 * @property string $token
 */
class PhoneVerifyRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'token'=>'request|string|max:255',
        ];
    }
}
