<?php declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use Auth;

class UserProvider
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
