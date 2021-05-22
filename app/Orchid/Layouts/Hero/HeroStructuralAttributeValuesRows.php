<?php declare(strict_types=1);

namespace App\Orchid\Layouts\Hero;

use App\Models\Characteristic;
use App\Models\Game;
use App\Models\StructuralAttribute;
use App\Models\StructuralAttributeValue;
use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class HeroStructuralAttributeValuesRows extends Rows
{
    protected array $mapAttributeToValues;
    public function __construct(array $mapAttributeToValues)
    {
        $this->mapAttributeToValues = $mapAttributeToValues;
    }

    protected function fields() : array
    {
        $fields = [];
        /** @var StructuralAttributeValue[] $values */
        foreach ($this->mapAttributeToValues as $values)
        {
            $values = collect($values);
            /** @var StructuralAttribute $attribute */
            $attribute = $values->first()->attribute;

            $field = Relation::make('hero.structural_attribute_values.')
                ->title($attribute->name)
                ->disabled()
                ->value($values->pluck('id'))
                ->fromModel(StructuralAttributeValue::class, 'name', 'id');

            if ($attribute->multiply)
                $field->multiple();

            $fields[] = $field;
        }
        return $fields;
    }
}
