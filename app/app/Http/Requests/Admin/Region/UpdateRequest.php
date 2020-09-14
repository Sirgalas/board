<?php

namespace App\Http\Requests\Admin\Region;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateRequest
 * @package App\Http\Requests\Admin\Region * @property string $name
 * @property string $name
 * @property string $slug
 */

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('regions','name')->where(function ($query) {
                    return $query->whereNull('name')->orWhere('id','!=',$this->parent);
                })
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('regions','name')->where(function ($query) {
                    return $query->whereNull('slug')->orWhere('id','!=',$this->parent);
                })]
        ];
    }
}
