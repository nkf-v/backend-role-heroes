<?php declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class UserListLayout extends Table
{
    protected $target = 'users';

    /**
     * @return TD[]
     */
    protected function columns() : array
    {
        return [
            TD::make('login', 'Login')
                ->render(function (User $user)
                {
                    return Link::make($user->login)
                        ->route('platform.users.detail', ['user' => $user]);
                }),
            TD::make('heroes_count', 'Heroes count'),
            TD::make('created_at', 'Created')->date(),
            TD::make('updated_at', 'Updated')->date(),
        ];
    }
}
