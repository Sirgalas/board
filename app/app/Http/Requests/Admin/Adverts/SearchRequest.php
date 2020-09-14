<?php

namespace App\Http\Requests\Admin\Adverts;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SearchRequest
 * @package App\Http\Requests\Admin\Adverts
 * @property int $id
 * @property string $title
 * @property int $user
 * @property int $region
 * @property int $category
 * @property string $status
 */
class SearchRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'=>'integer',
            'title'=>'string',
            'user'=>'integer',
            'region'=>'integer',
            'category'=>'integer',
            'status'=>'string'
        ];
    }
}
