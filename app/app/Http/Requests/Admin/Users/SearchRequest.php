<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
/**
 * Class SearchRequest
 * @package App\Http\Requests\Admin\Users
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $status
 * @property string $role
 * @property string $permission
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
            'id'=>'string',
            'name'=>'string',
            'email'=>'string',
            'status'=>'string',
            'role'=>'string',
            'permission'=>'string'
        ];
    }
}
