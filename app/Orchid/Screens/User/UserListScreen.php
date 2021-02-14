<?php declare(strict_types=1);

namespace App\Orchid\Screens\User;

use App\Models\User;
use App\Orchid\Layouts\User\UserListLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class UserListScreen extends Screen
{
    public $name = 'Users';
    public $description = 'All users application';

    public function query() : array
    {
        return [
            'users' => User::query()
                ->withCount('heroes')
                ->get(),
        ];
    }

    /**
     * @return Action[]
     */
    public function commandBar() : array
    {
        return [];
    }

    /**
     * @return string[]|Layout[]
     */
    public function layout() : array
    {
        return [
            UserListLayout::class
        ];
    }
}
