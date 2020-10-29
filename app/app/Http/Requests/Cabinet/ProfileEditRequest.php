<?php

namespace App\Http\Requests\Cabinet;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProfileEditRequest
 * @package App\Http\Requests\Cabinet
 * @property string $name
 * @property string $last_name
 * @property string $phone
 */
class ProfileEditRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules():array
    {
        return [
            'name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'phone'=>'required|string|max:255|regex:/^\d+$/s'
        ];
    }
}
/**
 * @OA\Schema(
 *    schema="ProfileEditRequest",
 *    @OA\Property(
 *        property="name",
 *        type="string"
 *    ),
 *    @OA\Property(
 *        property="last_name",
 *        type="string"
 *    ),
 *    @OA\Property(
 *        property="phone",
 *        type="string"
 *    )
 * )
 */