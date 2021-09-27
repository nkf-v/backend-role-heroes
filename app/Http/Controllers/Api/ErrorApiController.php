<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ErrorApiController extends ApiController
{
    public function error() : JsonResponse
    {
        return $this->respondContent(['error'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
