<?php declare(strict_types=1);

namespace App\Orchid\Screens\Employee;

use App\Modules\Employees\Models\Employee;
use App\Orchid\Layouts\Employee\EmployeeEditLayout;
use App\Orchid\Layouts\Employee\PasswordLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class EmployeeProfileScreen extends Screen
{
    public $name = 'My account';
    public $description = 'Update your account details such as name, email address and password';

    public function query(Request $request) : array
    {
        return [
            'employee' => $request->user(),
        ];
    }

    /**
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
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

            Layout::block(PasswordLayout::class)
                ->title(__('Update Password'))
                ->description(__('Ensure your account is using a long, random password to stay secure.'))
                ->commands(
                    Button::make(__('Update password'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save')
                ),
        ];
    }

    public function save(Request $request)
    {
        $request->validate([
            'employee.name'  => 'required|string',
            'employee.email' => [
                'required',
                Rule::unique(Employee::class, 'email')->ignore($request->user()),
            ],
        ]);

        $request->user()
            ->fill($request->get('employee'))
            ->save();

        Toast::info(__('Profile updated.'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|password:web',
            'password'     => 'required|confirmed',
        ]);

        tap($request->user(), function ($employee) use ($request) {
            $employee->password = Hash::make($request->get('password'));
        })->save();

        Toast::info(__('Password changed.'));
    }
}
