<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Providers\UserProvider;
use Auth;
use Grpc\Server;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Nkf\Laravel\Classes\Exceptions\ServerError;
use Nkf\Laravel\Traits\ApiController;

class AuthApiController extends Controller
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
        return $this->responseWithToken(Auth::login($user));
    }

    public function login(LoginRequest $request) : JsonResponse
    {
        $credentials = $request->validated();
        $token = auth()->attempt($credentials);

        if (!$token)
            throw new ServerError(['login' => ['invalid_login_password']]);

        return $this->responseWithToken($token);
    }

    public function logout() : JsonResponse
    {
        Auth::logout();
        return $this->respondContent(['message' => 'Successful logged out']);
    }
}
