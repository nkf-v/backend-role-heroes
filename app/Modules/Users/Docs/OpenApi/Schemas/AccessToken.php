<?php

namespace App\Modules\Users\Docs\OpenApi\Schemas;

/**
 * @OA\Schema (
 *     title = "Access token info",
 *     type = "object",
 *     schema = "AccessToken",
 *     @OA\Property (
 *         title = "Access token",
 *         property = "access_token",
 *         type = "string",
 *         format = "string",
 *     ),
 *     @OA\Property (
 *         title = "Token type",
 *         property = "token_type",
 *         type = "string",
 *         format = "string",
 *     ),
 *     @OA\Property (
 *         title = "Expire time",
 *         property = "expires_in",
 *         type = "int",
 *         format = "int64",
 *     ),
 * ),
 */
interface AccessToken
{

}
