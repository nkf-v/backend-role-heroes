<?php declare(strict_types=1);

namespace App\Modules\Categories\Admin\Orchid\Screens;

use App\Modules\Categories\Admin\Orchid\Layouts\CategoryRows;
use App\Modules\Categories\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class CategoryEdit extends Screen
{
    public $name = 'Category';

    protected bool $exist;

    public function query(Category $category) : array
    {
        $this->exist = $category->exists;

        if ($this->exist)
            $this->name = $category->name;

        return [
            'category' => $category,
        ];
    }

    public function commandBar() : array
    {
        return [
            Button::make('Create')
                ->icon('plus')
                ->canSee(!$this->exist)
                ->method('createOrUpdate'),
            Button::make('Update')
                ->icon('pencil')
                ->canSee($this->exist)
                ->method('createOrUpdate'),
            Button::make('Delete')
                ->icon('trash')
                ->canSee($this->exist)
                ->method('delete'),
        ];
    }

    public function layout() : array
    {
        return [
            new CategoryRows(!$this->exist),
        ];
    }

    protected function createOrUpdate(Category $category, Request $request) : RedirectResponse
    {
        $categoryData = $request->get('category');
        $category->name = $categoryData['name'];
        $category->save();

        Alert::success('Category saved');

        return redirect(route('platform.categories.edit', $category));
    }

    protected function delete(Category $category) : RedirectResponse
    {
        $category->delete();

        Alert::success('Category deleted');

        return redirect(route('platform.categories.list'));
    }
}
