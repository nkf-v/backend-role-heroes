<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Providers\UserProvider;
use Nkf\Laravel\Classes\ApiController as BaseApiController;

/**
 * @OA\Info (
 *  title = "RoleHeroes API",
 *  version = "1.0.0"
 * )
 * @OA\Tag (
 *     name = "Games",
 *     description = "Methods for work with games"
 * )
 * @OA\Tag (
 *     name = "Auth",
 *     description = "Methods auth for clients"
 * )
 * @OA\Server (
 *     url = "http:\\localhost:2609/api/",
 *     description = "local server"
 * )
 * @OA\Server (
 *     url = "https://test-role-heroes.herokuapp.com/api/",
 *     description = "Test server"
 * )
 * @OA\SecurityScheme (
 *     type = "http",
 *     description = "Auth by JWT",
 *     scheme = "bearer",
 *     bearerFormat = "JWT",
 *     securityScheme = "bearer"
 * )
 */
abstract class ApiController extends BaseApiController
{
    protected UserProvider $userProvider;

    public function __construct(UserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
    }
}
