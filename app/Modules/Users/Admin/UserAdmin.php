<?php

namespace App\Modules\Users\Admin;

use App\Admin\OrchidAdmin;
use App\Modules\Games\Admin\Orchid\Screens\GameEdit;
use App\Modules\Games\Admin\Orchid\Screens\GameList;
use App\Modules\Users\Admin\Orchid\Screens\UserEdit;
use App\Modules\Users\Admin\Orchid\Screens\UserList;
use App\Modules\Users\Models\User;

class UserAdmin extends OrchidAdmin
{
    protected string $mainRoute = 'users';
    protected string $mainRouteItem = 'user';
    protected string $listScreen = UserList::class;
    protected string $editScreen = UserEdit::class;

    protected string $model = User::class;
}
