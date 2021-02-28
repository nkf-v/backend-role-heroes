<?php declare(strict_types=1);

namespace App\Orchid\Layouts\Characteristic;

use App\Models\Game;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class CharacteristicEditRows extends Rows
{
    protected $isCreate = false;

    public function __construct(bool $isCreate)
    {
        $this->isCreate = $isCreate;
    }

    protected function fields(): array
    {
        return [
            DateTimer::make('characteristic.created_at')
                ->title('Created')
                ->disabled()
                ->canSee(!$this->isCreate),
            DateTimer::make('characteristic.updated_at')
                ->title('Updated')
                ->disabled()
                ->canSee(!$this->isCreate),
            Relation::make('characteristic.game_id')
                ->title('Game')
                ->placeholder('Select game')
                ->required()
                ->fromModel(Game::class, 'name', 'id'),
            Input::make('characteristic.name')
                ->title('Name')
                ->placeholder('Emter name')
                ->required(),
            TextArea::make('characteristic.description')
                ->title('Description')
                ->required()
                ->placeholder('Enter description')
                ->rows(4),
        ];
    }
}
