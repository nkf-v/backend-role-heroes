<?php

namespace Database\Seeders;

use App\Modules\Employees\Models\Employee;

class EmployeeFixture
{
    public function run()
    {
        for ($i = random_int(1, 3); $i --> 0;)
        {
            $employee = new Employee();
            $employee->name = sprintf('admin%s', $i + 1);
            $employee->email = sprintf('admin%s@email.com', $i + 1);
            $employee->password = bcrypt('qweqwe');
            $employee->permissions = [
                'platform.index' => true,
                'platform.systems.index' => true,
                'platform.systems.roles' => true,
                'platform.systems.employees' => true,
                'platform.systems.attachment' => true,
            ];
            $employee->save();
        }
    }
}
