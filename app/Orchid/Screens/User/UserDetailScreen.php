<?php declare(strict_types=1);

namespace App\Orchid\Screens\User;

use App\Models\User;
use App\Orchid\Layouts\User\UserDetailLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class UserDetailScreen extends Screen
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
            UserDetailLayout::class
        ];
    }
}
