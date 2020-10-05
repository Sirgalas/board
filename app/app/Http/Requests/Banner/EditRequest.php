<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditRequest
 * @package App\Http\Requests\Banner
 * @property string $name
 * @property int $limit
 * @property string $url
 */
class EditRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules():array
    {
        return [
            'name'=>'required|string',
            'limit'=>'required|integer',
            'url'=>'required|url'
        ];
    }
}
