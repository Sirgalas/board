<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Entity\Banner\Banner;

/**
 * Class CreateRequest
 * @package App\Http\Requests\Banner
 * @property string $name
 * @property int $limit
 * @property string $url
 * @property string $format
 */

class CreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules():array
    {
        [$width, $height] = [0, 0];
        if ($format = $this->input('format')) {
            [$width, $height] = explode('x', $format);
        }

        return [
            'name'=>'required|string',
            'limit'=>'required|integer',
            'url'=>'required|url',
            'format' => ['required', 'string', Rule::in(Banner::$formatsList)],
            'file' => 'required|image|mimes:jpg,jpeg,png|dimensions:width=' . $width . ',height=' . $height,
        ];
    }
}
