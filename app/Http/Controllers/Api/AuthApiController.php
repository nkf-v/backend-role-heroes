<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Providers\UserProvider;
use Auth;
use Illuminate\Http\JsonResponse;
use Nkf\Laravel\Classes\Exceptions\ServerError;
use Nkf\Laravel\Traits\ApiController;

class AuthApiController
{
    use ApiController;

    private $userProvider;

    public function __construct(UserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    public function register(UserRequest $request) : JsonResponse
    {
        $newUser = $request->validated();

        if (User::whereLogin($newUser['login'])->count() > 0)
            throw new ServerError(['login' => ['not_unique']]);

        $user = new User();
        $user->login = $newUser['login'];
        $user->password = bcrypt($newUser['password']);
        $user->save();
        return $this->responseWithToken(Auth::guard('api')->login($user));
    }

    public function login(LoginRequest $request) : JsonResponse
    {
        $credentials = $request->validated();
        $token = auth('api')->attempt($credentials);

        if (!$token)
            throw new ServerError(['login' => ['invalid_login_password']]);

        return $this->responseWithToken($token);
    }

    public function logout() : JsonResponse
    {
        Auth::guard('api')->logout();
        return $this->respondContent(['message' => 'Successful logged out']);
    }

    public function refresh() : JsonResponse
    {
        return $this->responseWithToken(Auth::guard('api')->refresh());
    }

    public function check() : JsonResponse
    {
        if ($this->userProvider->getOptionalUser() === null)
            throw new ServerError(['user' => ['no_auth']]);
        return $this->respondContent(['message' => 'KEKW']);
    }
}
