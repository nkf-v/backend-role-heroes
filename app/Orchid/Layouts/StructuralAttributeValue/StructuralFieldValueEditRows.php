<?php declare(strict_types=1);

namespace App\Orchid\Layouts\StructuralAttributeValue;

use App\Models\StructuralAttribute;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class StructuralFieldValueEditRows extends Rows
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
            Relation::make('value.attribute_id')
                ->value($this->attributeId)
                ->title('Attribute')
                ->fromModel(StructuralAttribute::class, 'name', 'id')
                ->disabled(),
            Input::make('value.name')
                ->title('Name'),
            TextArea::make('value.description')
                ->title('Description'),
        ];
    }
}
