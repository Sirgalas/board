<?php

namespace App\Http\Requests\Adverts;

use App\Entity\Adverts\Attribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $items=[];
        foreach ($this->advert->category->allAttributes() as $attribute){
            /** @var $attribute Attribute */
            $rules=[
                $attribute->required?'required' : 'nullable',
            ];
            switch ($attribute){
                case $attribute->isInteger():
                    $rules[]='integer';
                    break;
                case $attribute->isFloat():
                    $rules[]='number';
                    break;
                case $attribute->isString():
                    $rules[]='string';
                    $rules[]='max:255';
                    break;
                case $attribute->isSelect():
                    $rules[]=Rule::in($attribute->variants);
            }
            $items['attribute.'.$attribute->id]=$rules;
        }
        return array_merge([
            'title'=>'required|string',
            'content'=>'required|string',
            'price'=>'required|integer',
            'address'=>'required|string'
        ],$items);
    }
}
