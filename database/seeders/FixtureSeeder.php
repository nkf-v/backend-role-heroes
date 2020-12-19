<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Characteristic;
use App\Models\Employee;
use App\Models\Game;
use App\Models\User;
use Faker\Generator;
use Illuminate\Support\Str;
use Nkf\General\Utils\JsonUtils;
use Nkf\General\Utils\PathUtils;

class FixtureSeeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = app(Generator::class);
    }

    protected function getValueFromDatum($data, $key, callable $getDefaultValue)
    {
        return (($data[$key] ?? null) === null) ? $getDefaultValue() : $data[$key];
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

        $gameData = JsonUtils::decodeFile(PathUtils::join(__DIR__, 'fixtures', 'games_fixture.json'));
        $gameIds = [];
        foreach ($gameData as $gameDatum)
        {
            $game = new Game();
            $game->name = $this->getValueFromDatum($gameDatum, 'name', function () { return $this->faker->sentence(2); });
            $game->description = $this->getValueFromDatum($gameDatum, 'description', function () { return $this->faker->text; });
            $game->save();
            $gameIds[] = $game->id;
        }

        $characteristicData = JsonUtils::decodeFile(PathUtils::join(__DIR__, 'fixtures', 'characteristics_fixture.json'));
        foreach ($characteristicData as $characteristicDatum)
        {
            $characteristic = new Characteristic();
            $characteristic->name = $this->getValueFromDatum($characteristicDatum, 'name', function () { return $this->faker->text(10); });
            $characteristic->description = $this->getValueFromDatum($characteristicDatum, 'description', function () { return $this->faker->text; });
            $characteristic->game_id = $this->getValueFromDatum($characteristicDatum, 'description', function () use ($gameIds) { return $this->faker->randomElement($gameIds); });
            $characteristic->save();
        }
    }
}
