<?php

namespace App\Http\Requests\Admin\Ticket;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SearchRequest
 * @package App\Http\Requests\Admin\Ticket
 * @property int $id
 * @property int $user_id
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
            'id' => 'integer',
            'user_id' => 'integer',
            'status' => 'string|max:16',
        ];
    }
}
