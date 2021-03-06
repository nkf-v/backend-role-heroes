<?php declare(strict_types=1);

namespace App\Orchid\Screens\Attribute;

use App\Models\Attribute;
use App\Orchid\Layouts\Attribute\AttributeListTable;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class AttributeListScreen extends Screen
{
    public $name = 'Attributes';

    public function query() : array
    {
        return [
            'attributes' => Attribute::with(['category', 'game'])->paginate(10),
        ];
    }

    public function commandBar() : array
    {
        return [
            Link::make('Create')
                ->icon('plus')
                ->route('platform.attributes.edit'),
        ];
    }

    public function layout() : array
    {
        return [
            AttributeListTable::class,
        ];
    }
}
