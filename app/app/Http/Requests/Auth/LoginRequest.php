<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package App\Http\Requests\Auth
 * @property string $email
 * @property string $password
 */
class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
/**
 * @OA\Schema(
 *    schema="LoginRequest",
 *    @OA\Property(
 *        property="email",
 *        type="string"
 *    ),
 *    @OA\Property(
 *        property="password",
 *        type="string"
 *    )
 * )
 */