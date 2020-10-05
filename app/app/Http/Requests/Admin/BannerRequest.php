<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BannerRequest
 * @package App\Http\Requests\Admin
 * @property int $id
 * @property string $user
 * @property int $region
 * @property int $category
 * @property string $status
 */
class BannerRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'=>'integer',
            'user'=>'string',
            'region'=>'integer',
            'category'=>'integer',
            'status'=>'string'
        ];
    }
}
