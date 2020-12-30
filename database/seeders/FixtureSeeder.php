<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\AttributeTypeEnum;
use App\Models\Attribute;
use App\Models\AttributeCategory;
use App\Models\AttributeValue;
use App\Models\Characteristic;
use App\Models\Employee;
use App\Models\Game;
use App\Models\User;
use App\Models\UserHero;
use Faker\Generator;
use Illuminate\Support\Str;
use Nkf\General\Utils\ArrayUtils;
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
        $games = [];
        foreach ($gameData as $gameDatum)
        {
            $game = new Game();
            $game->name = $this->getValueFromDatum($gameDatum, 'name', function () { return $this->faker->sentence(2); });
            $game->description = $this->getValueFromDatum($gameDatum, 'description', function () { return $this->faker->text; });
            $game->save();
            $games[] = $game;
        }

        $characteristicData = JsonUtils::decodeFile(PathUtils::join(__DIR__, 'fixtures', 'characteristics_fixture.json'));
        foreach ($characteristicData as $characteristicDatum)
        {
            $characteristic = new Characteristic();
            $characteristic->name = $this->getValueFromDatum($characteristicDatum, 'name', function () { return $this->faker->text(10); });
            $characteristic->description = $this->getValueFromDatum($characteristicDatum, 'description', function () { return $this->faker->text; });
            $characteristic->game_id = $this->getValueFromDatum($characteristicDatum, 'description', function () use ($games) { return $this->faker->randomElement($games)->id; });
            $characteristic->save();
        }

        $categoryData = JsonUtils::decodeFile(PathUtils::join(__DIR__, 'fixtures', 'attributes_fixtures.json'));
        foreach ($categoryData as $categoryDatum)
        {
            $category = new AttributeCategory();
            $category->name = $this->getValueFromDatum($categoryDatum, 'name', function () { return $this->faker->sentence(random_int(1, 2)); });
            $category->save();

            foreach ($categoryDatum['attributes'] ?? [] as $attributeDatum)
            {
                $attribute = new Attribute();
                $attribute->name = $this->getValueFromDatum($attributeDatum, 'name', function () { return $this->faker->sentence(random_int(1, 3)); });
                $attribute->description = $this->getValueFromDatum($attributeDatum, 'description', function () { return $this->faker->boolean ? null : $this->faker->text; });
                $attribute->game_id = $this->getValueFromDatum($attributeDatum, 'game_id', function () use ($games) { return $this->faker->randomElement($games); });
                $attribute->type_value = AttributeTypeEnum::getVariables()[$attributeDatum['type_value'] ?? 'string'];
                $attribute->category_id = $category->id;
                $attribute->save();
                $attributes[] = $attribute;
            }
        }

        foreach ($userIds as $userId)
        {
            for ($i = random_int(5, 10); $i --> 0;) {
                $hero = new UserHero();
                $hero->user_id = $userId;
                $hero->name = $this->faker->sentence(2);
                $hero->note = $this->faker->boolean ? null : $this->faker->text;
                $hero->game_id = $this->faker->randomElement($games)->id;
                $hero->save();

                /** @var Characteristic $characteristic */
                foreach ($hero->game->characteristics as $characteristic)
                    $hero->characteristicValues()->attach($characteristic->id, ['value' => random_int(10, 100)]);

                /** @var Attribute $attribute */
                foreach ($hero->game->attributeModels as $attribute)
                {
                    $attributeValue = new AttributeValue();
                    $attributeValue->hero_id = $hero->id;
                    $attributeValue->attribute_id = $attribute->id;
                    $value = $this->faker->sentence(random_int(1, 2));
                    if ($attribute->type_value === AttributeTypeEnum::INT)
                        $value = random_int(0, 100);
                    else if ($attribute->type_value === AttributeTypeEnum::BOOL)
                        $value = $this->faker->boolean;
                    else if ($attribute->type_value === AttributeTypeEnum::DOUBLE)
                        $value = $this->faker->randomFloat(2, 0, 100);
                    $attributeValue->value = $value;
                    $attributeValue->save();
                }
            }
        }
    }
}
