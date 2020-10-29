<?php

namespace App\Http\Controllers\Api\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Http\Controllers\Controller;
use App\Http\Requests\Adverts\SearchRequest;
use App\Http\Resources\Adverts\AdvertDetailResource;
use App\Http\Resources\Adverts\AdvertListResource;
use App\UseCases\Adverts\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdvertController extends Controller
{
    private $search;

    public function __construct(SearchService $search)
    {
        $this->search = $search;
    }

/**
 * @OA\Get(
 *     path="/adverts",
 *     tags={"Adverts"},
 *     @OA\RequestBody(
 *         description="login user",
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/AdvertList")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="return success field",
 *             @OA\JsonContent(
 *                 type="array",
 *                 @OA\Items(ref="#/components/schemas/AdvertList")
 *         ),
 *     ),
 * )
 */
    public function index(SearchRequest $request)
    {
        $region = $request->get('region') ? Region::findOrFail($request->get('region')) : null;
        $category = $request->get('category') ? Category::findOrFail($request->get('category')) : null;

        $result = $this->search->search($category, $region, $request, 20, $request->get('page', 1));

        return AdvertListResource::collection($result->adverts);
    }

    /**

     * @OA\Get(
     *     path="/adverts/{advertId}",
     *     tags={"Adverts"},
     *     @OA\RequestBody(
     *         description="login user",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AdvertDetail")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="return success field",
     *             @OA\JsonContent(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/AdvertDetail")
     *         ),
     *     ),
     * )
     */
    public function show(Advert $advert)
    {
        if (!($advert->isActive() || Gate::allows('show-advert', $advert))) {
            abort(403);
        }

        return new AdvertDetailResource($advert);
    }
}
