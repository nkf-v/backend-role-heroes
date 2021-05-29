<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

class ErrorApiController extends ApiController
{
    public function error() : JsonResponse
    {
        return $this->respondContent(['error']);
    }
}
