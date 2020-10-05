<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class GetRequest
 * @package App\Http\Requests\Banner
 * @property string $format
 * @property int $category
 * @property int $region
 */
class GetRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'format'=>'string',
            'category'=>'integer',
            'region'=>'integer'
        ];
    }
}
