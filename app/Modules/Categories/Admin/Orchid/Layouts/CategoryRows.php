<?php declare(strict_types=1);

namespace App\Modules\Categories\Admin\Orchid\Layouts;

use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class CategoryRows extends Rows
{
    protected bool $isCreated = false;

    public function __construct(bool $isCreated)
    {
        $this->isCreated = $isCreated;
    }

    protected function fields() : array
    {
        return [
            DateTimer::make('category.created_at')
                ->title('Created')
                ->canSee(!$this->isCreated)
                ->disabled(),
            DateTimer::make('category.updated_at')
                ->title('Updated')
                ->canSee(!$this->isCreated)
                ->disabled(),
            Input::make('category.name')
                ->title('Name')
                ->placeholder('Enter category name')
                ->required(),
        ];
    }
}
