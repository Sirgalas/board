<?php

namespace App\Http\Requests\Adverts;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RejectRequest
 * @package App\Http\Requests\Adverts
 * @property  string $reason
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
