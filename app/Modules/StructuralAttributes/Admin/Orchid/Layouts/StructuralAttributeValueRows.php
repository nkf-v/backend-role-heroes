<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Admin\Orchid\Layouts;

use App\Modules\StructuralAttributes\Models\StructuralAttributeValueGroup;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class StructuralAttributeValueRows extends Rows
{
    protected bool $isCreate;
    protected int $attributeId;

    public function __construct(bool $isCreate, int $attributeId)
    {
        $this->isCreate = $isCreate;
        $this->attributeId = $attributeId;
    }

    protected function fields() : array
    {
        return [
            DateTimer::make('value.created_at')
                ->title('Created')
                ->disabled()
                ->canSee(!$this->isCreate),
            DateTimer::make('value.updated_at')
                ->title('Updated')
                ->disabled()
                ->canSee(!$this->isCreate),
            Relation::make('value.group_id')
                ->title('Group')
                ->placeholder('Select group')
                ->fromModel(StructuralAttributeValueGroup::class, 'name', 'id'),
            Input::make('value.name')
                ->title('Name')
                ->required(),
            TextArea::make('value.description')
                ->title('Description'),
        ];
    }
}
