<?php

namespace App\Http\Requests\Admin\Region;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class CreateRequest
 * @package App\Http\Requests\Admin\Region
 * @property string $name
 * @property string $slug
 * @property integer $parent
 */
class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
            })],
            'parent' => 'nullable|exists:regions,id',
        ];
    }
}
