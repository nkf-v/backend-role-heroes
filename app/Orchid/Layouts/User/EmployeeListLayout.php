<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Models\Employee;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class EmployeeListLayout extends Table
{
    public $target = 'users';

    public function columns() : array
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Employee $employee) {
                    return new Persona($employee->presenter());
                }),

            TD::make('email', __('Email'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Employee $employee) {
                    return ModalToggle::make($employee->email)
                        ->modal('oneAsyncModal')
                        ->modalTitle($employee->presenter()->title())
                        ->method('saveUser')
                        ->asyncParameters([
                            'user' => $employee->id,
                        ]);
                }),

            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(function (Employee $employee) {
                    return $employee->updated_at->toDateTimeString();
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Employee $employee) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.systems.employees.edit', $employee->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->parameters([
                                    'id' => $employee->id,
                                ]),
                        ]);
                }),
        ];
    }
}
