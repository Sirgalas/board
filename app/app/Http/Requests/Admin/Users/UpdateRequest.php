<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Entity\User\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class UpdateRequest
 * @package App\Http\Requests\Admin\Users
 * @property string $name
 * @property string $email
 * @property string $status
 * @property string $role
 * @property string $permission
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
            'name' => 'required|string|max:255',
            'email' => ["required","string","email","max:255",Rule::unique('users')->ignore($this->user->id),],
            'role' => ['required', 'string', Rule::in(User::$rolesName)],
            'permission'=>['string',Rule::in(User::$permissions)]
        ];
    }
}
