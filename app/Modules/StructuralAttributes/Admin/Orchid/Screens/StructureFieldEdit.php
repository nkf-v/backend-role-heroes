<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Admin\Orchid\Screens;

use App\Modules\StructuralAttributes\Admin\Orchid\Layouts\StructureFieldEditRows;
use App\Modules\StructuralAttributes\Models\StructureField;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class StructureFieldEdit extends Screen
{
    public $name = 'Field';
    protected int $attributeId;
    protected string $attributeName;

    protected function query(StructureField $field) : array
    {
        $this->name = $field->name;
        $this->attributeId = $field->attribute_id;
        $this->attributeName = $field->attribute->name;

        return [
            'field' => $field,
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Update')
                ->icon('pencil')
                ->method('update'),
            Button::make('Delete')
                ->icon('trash')
                ->method('delete'),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                Link::make($this->attributeName)
                    ->icon('arrow-left')
                    ->route('platform.structural_attributes.edit', $this->attributeId),
            ]),
            StructureFieldEditRows::class,
        ];
    }

    protected function update(StructureField $field, Request $request) : RedirectResponse
    {
        $fieldData = $request->get('field');
        $field->name = $fieldData['name'];

        try
        {
            $field->save();
        }
        catch(Exception $exception)
        {
            Alert::error('Update failed');
        }

        return redirect(route('platform.structure_fields.edit', $field->id));
    }

    protected function delete(StructureField  $field) : RedirectResponse
    {
        $field->delete();

        Alert::success('Delete success');

        return redirect(route('platform.structural_attributes.edit', $field->attribute_id));
    }
}
