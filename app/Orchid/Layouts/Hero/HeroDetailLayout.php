<?php declare(strict_types=1);

namespace App\Orchid\Layouts\Hero;

use App\Models\Characteristic;
use App\Models\Game;
use App\Models\User;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class HeroDetailLayout extends Rows
{
    protected function fields() : array
    {
        return [
            DateTimer::make('hero.created_at')->readonly(),
            DateTimer::make('hero.updated_at')->readonly(),
            Relation::make('hero.game_id')
                ->title('Game')
                ->fromModel(Game::class, 'name', 'id')
                ->disabled(),
            Relation::make('hero.user_id')
                ->title('User')
                ->fromModel(User::class, 'login', 'id')
                ->disabled(),
            Input::make('hero.name')
                ->title('Name')
                ->readonly(),
            TextArea::make('hero.note')
                ->title('Note')
                ->rows(5)
                ->readonly(),
        ];
    }
}
