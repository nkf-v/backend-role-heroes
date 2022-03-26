<?php declare(strict_types=1);

namespace App\Orchid\Layouts\StructuralAttribute;

use App\Models\Category;
use App\Models\Game;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class StructuralAttributeEditRows extends Rows
{
    protected $isCreated = false;

    public function __construct(bool $isCreated)
    {
        $this->isCreated = $isCreated;
    }

    protected function fields(): array
    {
        return [
            DateTimer::make('attribute.created_at')
                ->title('Created')
                ->disabled()
                ->canSee(!$this->isCreated),
            DateTimer::make('attribute.updated_at')
                ->title('Updated')
                ->disabled()
                ->canSee(!$this->isCreated),
            Relation::make('attribute.game_id')
                ->title('Games')
                ->placeholder('Select game')
                ->required()
                ->fromModel(Game::class, 'name', 'id'),
            Relation::make('attribute.category_id')
                ->title('Category')
                ->placeholder('Select category')
                ->fromModel(Category::class, 'name', 'id'),
            Input::make('attribute.name')
                ->title('Name')
                ->required()
                ->placeholder('Enter name attribute'),
            Switcher::make('attribute.multiply')
                ->title('Multiply')
                ->disabled(!$this->isCreated)
                ->value(false),
            TextArea::make('attribute.description')
                ->title('Description')
                ->rows(5)
                ->placeholder('Enter description attribute'),
        ];
    }
}
