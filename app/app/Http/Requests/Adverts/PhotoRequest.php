<?php

namespace App\Http\Requests\Adverts;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PhotoRequest
 * @package App\Http\Requests\Adverts
 * @property $files
 */
class PhotoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'files.*'=>'required|image|mimes:jpg,jpeg,png'
        ];
    }
}