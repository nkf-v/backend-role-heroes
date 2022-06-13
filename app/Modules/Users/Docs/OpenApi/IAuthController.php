<?php

namespace App\Modules\Users\Docs\OpenApi;

use App\Modules\Users\Requests\LoginRequest;
use App\Modules\Users\Requests\UserRequest;
use Illuminate\Http\JsonResponse;

interface IAuthController
{
    /**
     * @OA\Post (
     *     tags = {"Auth"},
     *     path = "/auth/register",
     *     summary = "Register user",
     *     operationId = "authRegistry",
     *     @OA\RequestBody (
     *         @OA\JsonContent (
     *             oneOf = {
     *                 @OA\Schema (ref="#/components/schemas/RegisterUser"),
     *             },
     *             @OA\Examples (
     *                 example = "New User",
     *                 value = {"login": "new_user", "password": "qweqwe", "password_confirmation": "qweqwe"},
     *                 summary = "Simple new user",
     *             ),
     *         ),
     *     ),
     *     @OA\Response (
     *         response = "200",
     *         description = "Success register",
     *         @OA\JsonContent (
     *             oneOf = {
     *                 @OA\Schema (ref = "#/components/schemas/AccessToken"),
     *             },
     *             @OA\Examples (
     *                 example = "result",
     *                 value = {"access_token": "example_token","token_type": "brear","expires_in": 604800},
     *                 summary = "Succes response by register"
     *             )
     *         ),
     *     )
     * )
     */
    public function register(UserRequest $request) : JsonResponse;

    /**
     * @OA\Post (
     *     tags = {"Auth"},
     *     path = "/auth/login",
     *     summary = "Login user",
     *     operationId = "authLogin",
     *     @OA\Response (
     *         response = "200",
     *         description = "Success login"
     *     )
     * )
     */
    public function login(LoginRequest $request) : JsonResponse;
    public function logout() : JsonResponse;
    public function refresh() : JsonResponse;
    public function check() : JsonResponse;
}
