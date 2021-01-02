<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Nkf\Laravel\Traits\ApiController;

class ErrorApiController extends Controller
{
    use ApiController;

    public function error() : JsonResponse
    {
        return $this->respondContent(['error']);
    }
}
