<?php declare(strict_types=1);

namespace App\Providers;

use App\Modules\Users\Models\User;
use Auth;

final class UserProvider
{
    public function getUser() : User
    {
        return Auth::guard('api')->user();
    }

    public function getOptionalUser() : ?User
    {
        return Auth::guard('api')->user();
    }

    public function isAuth() : bool
    {
        return $this->getOptionalUser() !== null;
    }
}
