<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\UseCases\Auth\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    private $service;

    public function __construct(RegisterService $service)
    {
        $this->service=$service;
    }

    /**
     * @OA\Post (
     *     path="/register",
     *      tags={"Auth"},
     *     @OA\RequestBody(
     *         description="order placed for purchasing th pet",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Check your email and click on the link to verify.",
     *             @OA\JsonContent(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/RegisterRequest")
     *         ),
     *     ),
     * )
     */


    public function register(RegisterRequest $request)
    {
        $this->service->register($request);
        return response()->json([
            'success' => 'Check your email and click on the link to verify.'
        ], Response::HTTP_CREATED);
    }
}
