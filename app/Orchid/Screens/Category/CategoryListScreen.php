<?php declare(strict_types=1);

namespace App\Orchid\Screens\Category;

use App\Models\Category;
use App\Orchid\Layouts\Category\CategoryListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CategoryListScreen extends Screen
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
            CategoryListLayout::class,
        ];
    }
}
