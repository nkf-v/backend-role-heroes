<?php declare(strict_types=1);

namespace App\Orchid\Screens\Employee;

use App\Modules\Employees\Models\Employee;
use App\Orchid\Layouts\Employee\EmployeeEditLayout;
use App\Orchid\Layouts\Employee\EmployeeFiltersLayout;
use App\Orchid\Layouts\Employee\EmployeeListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class EmployeeListScreen extends Screen
{
    public $name = 'Employee';
    public $description = 'All registered employees';
    public $permission = 'platform.systems.employees';

    public function query() : array
    {
        return [
            'employees' => Employee::with('roles')
                ->filters()
                ->filtersApplySelection(EmployeeFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    /**
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar() : array
    {
        return [];
    }

    /**
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout() : array
    {
        return [
            EmployeeFiltersLayout::class,
            EmployeeListLayout::class,

            Layout::modal('oneAsyncModal', EmployeeEditLayout::class)
                ->async('asyncGetEmployee'),
        ];
    }

    public function oneAsyncModal(Employee $employee) : array
    {
        return [
            'employee' => $employee,
        ];
    }

    public function saveEmployee(Employee $employee, Request $request) : void
    {
        $request->validate([
            'employee.email' => 'required|unique:employees,email,'.$employee->id,
        ]);

        $employee->fill($request->input('employee'))
            ->replaceRoles($request->input('employee.roles'))
            ->save();

        Toast::info(__('Employee was saved.'));
    }

    public function remove(Request $request) : void
    {
        Employee::findOrFail($request->get('id'))
            ->delete();

        Toast::info(__('Employee was removed'));
    }
}
