<?php

namespace App\Http\Requests\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Attribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
/**
 * @property Advert $advert
 */
class AttributesRequest extends FormRequest
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
        return $items;
    }
}
