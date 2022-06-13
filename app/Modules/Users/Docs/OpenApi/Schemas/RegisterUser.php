<?php

namespace App\Modules\Users\Docs\OpenApi\Schemas;

/**
 * @OA\Schema (
 *     title = "New user",
 *     schema = "RegisterUser",
 *     type = "object",
 *     @OA\Property (
 *         property = "login",
 *         type = "string",
 *         example = "user_user",
 *     ),
 *     @OA\Property (
 *         property = "password",
 *         type = "string",
 *         example = "qweqwe",
 *     ),
 *     @OA\Property (
 *         property = "password_confirmation",
 *         type = "string",
 *         example = "qweqwe",
 *     ),
 * ),
 */
interface RegisterUser {}
