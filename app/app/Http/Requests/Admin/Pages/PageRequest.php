<?php

namespace App\Http\Requests\Admin\Pages;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PageRequest
 * @package App\Http\Requests\Admin\Pages
 *
 * @property string $title
 * @property string $slug
 * @property string $menu_title
 * @property int $parent
 * @property string $content
 * @property string $description
 */
class PageRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'menu_title' => 'string|max:255',
            'parent' => 'nullable|integer|exists:pages,id',
            'content' => 'nullable|string',
            'description' => 'nullable|string',
        ];
    }
}
