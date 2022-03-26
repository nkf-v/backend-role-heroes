<?php declare(strict_types=1);

namespace App\Modules\Categories\Admin\Orchid\Screens;

use App\Modules\Categories\Models\Category;
use App\Modules\Categories\Admin\Orchid\Layouts\CategoryTable;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CategoryList extends Screen
{
    public $name = 'Categories';

    public function query() : array
    {
        return [
            'categories' => Category::paginate(10),
        ];
    }

    public function commandBar() : array
    {
        return [
            Link::make('Create')
                ->icon('plus')
                ->route('platform.categories.edit'),
        ];
    }

    public function layout() : array
    {
        return [
            CategoryTable::class,
        ];
    }
}
