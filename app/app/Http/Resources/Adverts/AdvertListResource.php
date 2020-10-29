<?php


namespace App\Http\Resources\Adverts;

use App\Entity\Adverts\Advert\Photo;
use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Entity\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $title
 * @property int $price
 * @property string $address
 * @property Carbon $published_at
 *
 * @property User $user
 * @property Region $region
 * @property Category $category
 * @property Photo[]|Collection $photos
 */
class AdvertListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => [
                'name' => $this->user->name,
                'phone' => $this->user->phone,
            ],
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ],
            'region' => $this->region ? [
                'id' => $this->region->id,
                'name' => $this->region->name,
            ] : [],
            'title' => $this->title,
            'price' => $this->price,
            'date' => $this->published_at,
            'photo' => is_object($this->photos->first())?$this->photos->first()->file:null,
        ];
    }
}
/**
 * @OA\Schema (
 *     schema="AdvertList",
 *     @OA\Property(
 *         property="id",
 *         type="integer"),
 *     @OA\Property(
 *         property="user",
 *         type="object",
 *         @OA\Property(
 *             property="name",
 *             type="string"),
 *         @OA\Property(
 *             property="phone",
 *             type="string"),
 *     ),
 *     @OA\Property(
 *         property="category",
 *         type="object",
 *         @OA\Property(
 *             property="id",
 *             type="integer"),
 *         @OA\Property(
 *             property="name",
 *             type="string"),
 *     ),
 *     @OA\Property(
 *         property="region",
 *         type="object",
 *         @OA\Property(
 *             property="id", type="integer"),
 *         @OA\Property(
 *             property="name",
 *             type="string"),
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string"),
 *     @OA\Property(
 *         property="price",
 *         type="integer"),
 *     @OA\Property(
 *         property="date",
 *         type="date"),
 *     @OA\Property(
 *         property="photo",
 *         type="string"),
 * )
 */