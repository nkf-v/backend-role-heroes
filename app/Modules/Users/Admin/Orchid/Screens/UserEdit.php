<?php declare(strict_types=1);

namespace App\Modules\Users\Admin\Orchid\Screens;

use App\Modules\Users\Admin\Orchid\Layouts\UserRows;
use App\Modules\Users\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class UserEdit extends Screen
{
    public $name = 'User';
    public $description = 'Detail info about user';

    public function query(int $userId) : array
    {
        $user = User::query()
            ->withCount('heroes')
            ->find($userId);

        $this->name = $user->login;
        $this->description = "Detail info about {$user->login}";

        return [
            'user' => $user,
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
    public function layout(): array
    {
        return [
            UserRows::class
        ];
    }
}
