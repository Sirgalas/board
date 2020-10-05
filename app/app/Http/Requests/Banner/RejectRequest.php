<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;


/**
 * Class RejectRequest
 * @package App\Http\Requests\Banner
 * @property string $reason
 */
class RejectRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'reason' => 'required|string',
        ];
    }
}
