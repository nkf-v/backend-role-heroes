<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class EmployeeEditLayout extends Rows
{
    public function fields() : array
    {
        return [
            Input::make('employee.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Input::make('employee.email')
                ->type('email')
                ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),
        ];
    }
}
