<?php declare(strict_types=1);

namespace App\Orchid\Layouts\Attribute;

use App\Enums\AttributeTypeEnum;
use App\Models\Category;
use App\Models\Game;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class AttributeEditRows extends Rows
{
    protected $isCreated = false;

    public function __construct(bool $isCreated)
    {
        $this->isCreated = $isCreated;
    }

    protected function fields() : array
    {
        return [
            DateTimer::make('attribute.created_at')
                ->title('Created')
                ->format('d.m.Y')
                ->canSee(!$this->isCreated),
            DateTimer::make('attribute.updated_at')
                ->title('Updated')
                ->format('d.m.Y')
                ->canSee(!$this->isCreated),
            Relation::make('attribute.game_id')
                ->title('Game')
                ->placeholder('Select game')
                ->required()
                ->fromModel(Game::class, 'name', 'id'),
            Relation::make('attribute.category_id')
                ->title('Category')
                ->placeholder('Select category')
                ->fromModel(Category::class, 'name', 'id'),
            Select::make('attribute.type_value')
                ->title('Type value')
                ->required()
                ->options(AttributeTypeEnum::getLabels()),
            Input::make('attribute.name')
                ->title('Name')
                ->required()
                ->placeholder('Enter name attribute'),
            TextArea::make('attribute.description')
                ->title('Description')
                ->rows(5)
                ->placeholder('Enter description attribute'),
        ];
    }
}
