<?php

namespace App\Http\Requests\Adverts;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SearchRequest
 * @package App\Http\Requests\Adverts
 * @property string $text
 */
class SearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'text' => 'nullable|string',
            'attrs.*.equals' => 'nullable|string',
            'attrs.*.from' => 'nullable|numeric',
            'attrs.*.to' => 'nullable|numeric',
        ];
    }
}
