<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Providers\UserProvider;
use Nkf\Laravel\Classes\ApiController as BaseApiController;

abstract class ApiController extends BaseApiController
{
    protected UserProvider $userProvider;

    public function __construct(UserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
    }
}
