<?php declare(strict_types=1);

namespace App\Modules\Categories\Admin\Orchid\Layouts;

use App\Modules\Categories\Models\Category;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryTable extends Table
{
    protected $target = 'categories';

    protected function columns() : array
    {
        return [
            // TODO sort_order
            TD::make('name', 'Name')
                ->render(function (Category $category) : Link
                {
                    return Link::make($category->name)->route('platform.categories.edit', $category);
                }),
            TD::make('created_at', 'Created')->date(),
            TD::make('updated_at', 'Updated')->date(),
        ];
    }
}
