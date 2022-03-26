<?php declare(strict_types=1);

namespace App\Orchid\Layouts\Hero;

use App\Models\Hero;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class HeroListLayout extends Table
{
    protected $target = 'heroes';

    protected function columns() : array
    {
        return [
            TD::make('name', 'Name')
                ->render(function (Hero $hero) : Link
                {
                    return Link::make($hero->name)->route('platform.heroes.detail', $hero);
                }),
            TD::make('game', 'Games')
                ->render(function (Hero $hero) : Link
                {
                    return Link::make($hero->game->name)
                        ->set('target', '_blank')
                        ->route('platform.games.edit', $hero->game);
                }),
            TD::make('user', 'User')
                ->render(function (Hero $hero) : Link
                {
                    return Link::make($hero->user->login)
                        ->set('target', '_blank')
                        ->route('platform.users.detail', $hero->user);
                }),
            TD::make('created_at', 'Created')->date(),
            TD::make('updated_at', 'Updated')->date(),
        ];
    }
}
