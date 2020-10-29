<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegisterRequest
 * @package App\Http\Requests\Auth
 * @property string $name
 * @property string $email
 * @property string $password
 */
class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
/**
 * @OA\Schema(
 *    schema="RegisterRequest",
 *    @OA\Property(
 *        property="name",
 *        type="string"
 *    ),
 *    @OA\Property(
 *        property="email",
 *        type="string"
 *    ),
 *    @OA\Property(
 *        property="password",
 *        type="string"
 *    ),
 *    @OA\Property(
 *        property="password_confirmation",
 *        type="string"
 *    )
 * )
 */