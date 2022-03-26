<?php declare(strict_types=1);

namespace App\Modules\Users\Admin\Orchid\Screens;

use App\Modules\Users\Admin\Orchid\Layouts\UserTable;
use App\Modules\Users\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class UserList extends Screen
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
            UserTable::class
        ];
    }
}
