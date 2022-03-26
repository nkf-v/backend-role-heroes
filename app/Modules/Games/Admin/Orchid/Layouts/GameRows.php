<?php declare(strict_types=1);

namespace App\Modules\Games\Admin\Orchid\Layouts;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class GameRows extends Rows
{
    protected bool $isCreated;

    public function __construct(bool $isCreated)
    {
        $this->isCreated = $isCreated;
    }

    /**
     * @return Field[]
     */
    protected function fields() : array
    {
        return [
            DateTimer::make('game.created_at')
                ->title('Created')
                ->disabled()
                ->canSee(!$this->isCreated),
            DateTimer::make('game.updated_at')
                ->title('Updated')
                ->disabled()
                ->canSee(!$this->isCreated),
            Input::make('game.name')
                ->title('Name')
                ->required()
                ->placeholder('Enter game name'),
            TextArea::make('game.description')
                ->title('Description')
                ->rows(5)
                ->required()
                ->placeholder('Enter game description'),
        ];
    }
}
