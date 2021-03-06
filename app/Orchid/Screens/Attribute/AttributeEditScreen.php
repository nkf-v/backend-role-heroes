<?php declare(strict_types=1);

namespace App\Orchid\Screens\Attribute;

use App\Models\Attribute;
use App\Orchid\Layouts\Attribute\AttributeEditRows;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class AttributeEditScreen extends Screen
{
    public $name = 'Attribute';
    protected $exists = false;

    public function query(Attribute $attribute) : array
    {
        $this->exists = $attribute->exists;

        if ($this->exists)
            $this->name = $attribute->name;

        return [
            'attribute' => $attribute,
        ];
    }

    public function commandBar() : array
    {
        return [
            Button::make('Create')
                ->icon('plus')
                ->method('createOrUpdate'),
            Button::make('Update')
                ->icon('pencil')
                ->method('createOrUpdate'),
            Button::make('Delete')
                ->icon('trash')
                ->method('delete'),
        ];
    }

    public function layout() : array
    {
        return [
            new AttributeEditRows(!$this->exists),
        ];
    }

    protected function createOrUpdate(Attribute $attribute, Request $request) : RedirectResponse
    {
        $attributeData = $request->get('attribute');
        $attribute->game_id = $attributeData['game_id'];
        $attribute->category_id = $attributeData['category_id'] ?? null;
        $attribute->type_value = $attributeData['type_value'];
        $attribute->name = $attributeData['name'];
        $attribute->description = $attributeData['description'] ?? null;
        $attribute->save();

        Alert::success('Save success');

        return redirect(route('platform.attributes.edit', $attribute));
    }

    protected function delete(Attribute $attribute) : RedirectResponse
    {
        $attribute->delete();

        Alert::success('Delete success');

        return redirect(route('platform.attributes.list'));
    }
}
