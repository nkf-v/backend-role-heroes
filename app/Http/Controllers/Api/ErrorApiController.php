<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Nkf\Laravel\Traits\ApiController;

class ErrorApiController
{
    use ApiController;

    public function error() : JsonResponse
    {
        return $this->respondContent(['error']);
    }
}
