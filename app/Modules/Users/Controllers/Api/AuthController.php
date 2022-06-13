<?php declare(strict_types=1);

namespace App\Modules\Users\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Modules\Users\Docs\OpenApi\IAuthController;
use App\Modules\Users\Models\User;
use App\Modules\Users\Requests\LoginRequest;
use App\Modules\Users\Requests\UserRequest;
use Auth;
use Illuminate\Http\JsonResponse;
use Nkf\Laravel\Classes\Exceptions\ServerError;

class AuthController extends ApiController implements IAuthController
{
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
        $token = Auth::guard('api')->attempt($credentials);

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
