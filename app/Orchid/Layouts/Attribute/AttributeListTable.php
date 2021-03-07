<?php declare(strict_types=1);

namespace App\Orchid\Layouts\Attribute;

use App\Models\Attribute;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AttributeListTable extends Table
{
    protected $target = 'attributes';

    protected function columns() : array
    {
        return [
            TD::make('name', 'Name')
                ->render(function (Attribute $attribute) : Link
                {
                    return Link::make($attribute->name)->route('platform.attributes.edit', $attribute);
                }),
            TD::make('game', 'Game')
                ->render(function (Attribute $attribute) : Link
                {
                    return Link::make($attribute->game->name)
                        ->set('target', '_blank')
                        ->route('platform.games.edit', $attribute->game);
                }),
            TD::make('category', 'Category')
                ->render(function (Attribute $attribute) : Link
                {
                    return Link::make($attribute->category->name)
                        ->set('target', '_blank')
                        ->route('platform.categories.edit', $attribute->category);
                }),
            TD::make('created_at', 'Created')->date(),
            TD::make('updated_at', 'Updated')->date(),
        ];
    }
}
