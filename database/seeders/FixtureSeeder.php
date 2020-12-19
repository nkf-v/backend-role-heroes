<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Faker\Generator;
use Illuminate\Support\Str;

class FixtureSeeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = app(Generator::class);
    }

    public function run() : void
    {
        for ($i = random_int(1, 3); $i --> 0;)
        {
            $employee = new Employee();
            $employee->name = sprintf('admin%s', $i + 1);
            $employee->email = sprintf('admin%s@email.com', $i + 1);
            $employee->password = bcrypt('qweqwe');
            $employee->remember_token = Str::random(10);
            $employee->save();
        }

        $userIds = [];
        for ($i = random_int(5, 8); $i --> 1;)
        {
            $user = new User();
            $user->login = $this->faker->userName;
            $user->password = bcrypt('qweqwe');
            $user->save();
            $userIds[] = $user->id;
        }
    }
}
