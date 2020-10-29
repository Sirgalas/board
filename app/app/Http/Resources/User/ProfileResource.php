<?php


namespace App\Http\Resources\User;


use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property bool $phone_verified
 */
class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'phone' => [
                'number' => $this->phone,
                'verified' => $this->phone_verified,
            ],
            'name' => [
                'first' => $this->name,
                'last' => $this->last_name,
            ],
        ];
    }
}
/**
 * @OA\Schema (
 *     schema="ProfileResource",
 *     @OA\Property(
 *          property="id",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="email",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="phone",
 *          type="object",
 *          @OA\Property(
 *              property="number",
 *              type="string"
 *          ),
 *         @OA\Property(
 *              property="verified",
 *              type="boolean"
 *          ),
 *     ),
 *     @OA\Property(
 *          property="name",
 *          type="object",
 *          @OA\Property(
 *              property="first",
 *              type="string"),
 *          @OA\Property(
 *              property="last",
 *              type="string"
 *          ),
 *     ),
 * )
 */