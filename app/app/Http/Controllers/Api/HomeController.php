<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/**
 * @OA\OpenApi(
 *    servers={
 *        {
 *            "url": "http://localhost:8300/api/",
 *            "description": "The baerer security filter is used for authorization on the service. You can get the token in your merchant profile."
 *        },
 *    }
 * )
 * @OA\Info(
 *    title="This api full project in Rosinfra sercvice",
 *    version="1.0.0",
 *    contact={
 *        "email": "support@example.com"
 *     }
 * )
 * @OA\SecurityScheme(
 *    in="header",
 *    name="Authorization",
 *    type="oauth2",
 *    securityScheme="bearerAuth",
 *    @OA\Flow(
 *        tokenUrl="https://localhost:8300/oauth/token",
 *        flow="implicit",
 *        scopes={
 *            "write:adverts": "modify pets in your account",
 *            "read:adverts": "read your pets",
 *       }
 *    )
 * ),
*/
class HomeController extends Controller
{
    /**
     *  /**
     *    @OA\Get(
     *        path="/",
     *
     *      tags={"Home"},
     *        @OA\Response(
     *          response="200",
     *          description="An example resource",
     *           @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="/")
     *         ),
     *      ),
     *    )
     */
    public function home()
    {
        return [
            'name' => 'Board API',
        ];
    }
}
