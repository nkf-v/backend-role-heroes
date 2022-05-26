<?php declare(strict_types=1);

namespace App\Modules\Employees\Models;

use Orchid\Platform\Models\User;

/**
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool[] $permissions
 */
class Employee extends User
{
    protected $table = 'employees';
}
