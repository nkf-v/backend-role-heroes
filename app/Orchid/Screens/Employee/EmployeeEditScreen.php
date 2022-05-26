<?php declare(strict_types=1);

namespace App\Orchid\Screens\Employee;

use App\Modules\Employees\Models\Employee;
use App\Orchid\Access\EmployeeSwitch;
use App\Orchid\Layouts\Employee\EmployeeEditLayout;
use App\Orchid\Layouts\Employee\EmployeeRoleLayout;
use App\Orchid\Layouts\Role\RolePermissionLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class EmployeeEditScreen extends Screen
{
    public $name = 'Employee';
    public $description = 'Details such as name, email and password';
    public $permission = 'platform.systems.employees';
    /** @var Employee */
    private $employee;

    public function query(Employee $employee) : array
    {
        $this->employee = $employee;

        $employee->load(['roles']);

        return [
            'employee'       => $employee,
            'permission' => $employee->getStatusPermission(),
        ];
    }

    /**
     * @return Action[]
     */
    public function commandBar() : array
    {
        return [
            Button::make(__('Impersonate employee'))
                ->icon('login')
                ->confirm('You can revert to your original state by logging out.')
                ->method('loginAs')
                ->canSee(\request()->user()->id !== $this->employee->id),

            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove'),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout() : array
    {
        return [

            Layout::block(EmployeeEditLayout::class)
                ->title(__('Profile Information'))
                ->description(__('Update your account\'s profile information and email address.'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save')
                ),

            Layout::block(EmployeeRoleLayout::class)
                ->title(__('Roles'))
                ->description(__('A Role defines a set of tasks a employee assigned the role is allowed to perform.'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save')
                ),

            Layout::block(RolePermissionLayout::class)
                ->title(__('Permissions'))
                ->description(__('Allow the user to perform some actions that are not provided for by his roles'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save')
                ),

        ];
    }

    public function save(Employee $employee, Request $request) : RedirectResponse
    {
        $request->validate([
            'employee.email' => [
                'required',
                Rule::unique(Employee::class, 'email')->ignore($employee),
            ],
        ]);

        $permissions = collect($request->get('permissions'))
            ->map(function ($value, $key) {
                return [base64_decode($key) => $value];
            })
            ->collapse()
            ->toArray();

        $employee
            ->fill($request->get('employee'))
            ->replaceRoles($request->input('employee.roles'))
            ->fill([
                'permissions' => $permissions,
            ])
            ->save();

        Toast::info(__('Employee was saved.'));

        return redirect()->route('platform.systems.employees');
    }

    public function remove(Employee $employee) : RedirectResponse
    {
        $employee->delete();

        Toast::info(__('Employee was removed'));

        return redirect()->route('platform.systems.employees');
    }

    public function loginAs(Employee $employee) : RedirectResponse
    {
        EmployeeSwitch::loginAs($employee);

        Toast::info(__('You are now impersonating this employee'));

        return redirect()->route(config('platform.index'));
    }
}
