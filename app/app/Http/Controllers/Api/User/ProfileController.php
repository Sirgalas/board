<?php

namespace App\Http\Controllers\Api\User;

use App\Entity\User\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\ProfileResource;
use App\UseCases\Profile\ProfileService;
use App\Http\Requests\Cabinet\ProfileEditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $service;

    public function __construct(ProfileService $service)
    {
        $this->service=$service;
    }

    /**
     * @OA\Get(
     *     path="/user",
     *     tags={"Profile"},
     *     @OA\RequestBody(
     *         description="order placed for purchasing th pet",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProfileResource")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Check your email and click on the link to verify.",
     *             @OA\JsonContent(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/ProfileResource")
     *         ),
     *     )
     * )
     */
    public function show(Request $request)
    {
        return new ProfileResource($request->user());
    }

    /**
     * @OA\Put(
     *     path="/user",
     *     tags={"Profile"},
     *     @OA\RequestBody(
     *         description="order placed for purchasing th pet",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProfileEditRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Check your email and click on the link to verify.",
     *             @OA\JsonContent(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/ProfileEditRequest")
     *         ),
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    public function update(ProfileEditRequest $request)
    {
        $this->service->edit($request->user()->id, $request);

        /** @var User $user */
        $user = User::findOrFail($request->user()->id);

        return new ProfileResource($user);
    }
}
