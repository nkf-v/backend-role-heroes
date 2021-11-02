<?php declare(strict_types=1);

namespace App\Orchid\Screens\StructuralAttribute;

use App\Models\StructuralAttribute;
use App\Models\StructureField;
use App\Orchid\Layouts\StructuralAttribute\StructuralAttributeEditRows;
use App\Orchid\Layouts\StructuralAttribute\StructureFieldCreateRows;
use App\Orchid\Layouts\StructuralAttribute\StructureFieldListTable;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class StructuralAttributeEditScreen extends Screen
{
    public $name = 'Structural attribute';
    protected bool $exists = false;
    protected ?int $attributeId = null;
    protected bool $existFields = false;

    public function query(StructuralAttribute $attribute) : array
    {
        $fields = [];
        $this->exists = $attribute->exists;

        if ($this->exists)
        {
            $this->attributeId = $attribute->id;
            $this->name = $attribute->name;
            $fields = $attribute->fields;
            $this->existFields = $fields->isNotEmpty();
        }

        return [
            'attribute' => $attribute,
            'fields' => $fields,
        ];
    }

    public function commandBar() : array
    {
        $commands = [
            Button::make('Create')
                ->icon('plus')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),
            Button::make('Update')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee($this->exists),
            Button::make('Delete')
                ->icon('trash')
                ->method('deleteStructuralAttribute')
                ->canSee($this->exists),
        ];

        if ($this->attributeId !== null)
        {
            $commands[] = Link::make('Values list')
                ->icon('list')
                ->route('platform.structural_attribute_values.list', $this->attributeId)
                ->canSee($this->exists);
        }

        return $commands;
    }

    public function layout() : array
    {
        $layouts = [new StructuralAttributeEditRows(!$this->exists)];

        if ($this->exists)
        {
            $layouts = array_merge($layouts, [
                Layout::modal('createField', new StructureFieldCreateRows($this->attributeId))
                    ->title('Create new field')
                    ->applyButton('Create')
                    ->closeButton('Cancel'),
                Layout::rows([
                    ModalToggle::make('Create field')
                        ->icon('plus')
                        ->modal('createField')
                        ->method('createNewField')
                        ->hidden(!$this->exists),
                ]),
            ]);

            if ($this->existFields)
                $layouts = array_merge($layouts, [new StructureFieldListTable($this->exists)]);
        }

        return $layouts;
    }

    public function createNewField(Request $request) : void
    {
        $fieldData = $request->get('new_field');

        $existField = StructureField::query()
            ->where('attribute_id', $fieldData['attribute_id'])
            ->where('name', $fieldData['name'])
            ->where('type', (int)$fieldData['type'])
            ->exists();

        if ($existField)
        {
            Alert::error('Such a field has already been created');
            return;
        }

        $field = new StructureField();
        $field->attribute_id = $fieldData['attribute_id'];
        $field->name = $fieldData['name'];
        $field->type = (int)$fieldData['type'];
        $field->save();

        Alert::success('A new field is successfully created');
    }

    protected function createOrUpdate(StructuralAttribute $attribute, Request $request) : RedirectResponse
    {
        $attributeData = $request->get('attribute');
        $attribute->game_id = $attributeData['game_id'];
        $attribute->category_id = $attributeData['category_id'] ?? null;

        if (array_key_exists('multiply', $attributeData))
            $attribute->multiply = $attributeData['multiply'];

        $attribute->name = $attributeData['name'];
        $attribute->description = $attributeData['description'] ?? null;
        $attribute->save();

        Alert::success('Save success');

        return redirect(route('platform.structural_attributes.edit', $attribute->id));
    }

    protected function deleteStructuralAttribute(StructuralAttribute $attribute) : RedirectResponse
    {
        $attribute->delete();

        Alert::success('Delete success');

        return redirect(route('platform.structural_attributes.list'));
    }
}
