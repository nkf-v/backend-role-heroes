<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\AttributeTypeEnum;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Employee;
use App\Models\Game;
use App\Models\Hero;
use App\Models\StructuralAttribute;
use App\Models\StructuralAttributeValue;
use App\Models\StructureField;
use App\Models\User;
use Faker\Generator;
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

    public function run() : void
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

        $userIds = [];
        for ($i = random_int(5, 8); $i --> 1;)
        {
            $user = new User();
            $user->login = sprintf('test.%d', $i);
            $user->password = bcrypt('qweqwe');
            $user->save();
            $userIds[] = $user->id;
        }

        $gameData = JsonUtils::decodeFile(PathUtils::join(__DIR__, 'fixtures', 'games_fixture.json'));
        $games = [];
        foreach ($gameData as $gameDatum)
        {
            $game = new Game();
            $game->name = $gameDatum['name'] ?? $this->faker->sentence(2);
            $game->description = $gameDatum['description'] ?? $this->faker->text;
            $game->save();
            $games[] = $game;
        }

        $characteristicData = JsonUtils::decodeFile(PathUtils::join(__DIR__, 'fixtures', 'characteristics_fixture.json'));
        foreach ($characteristicData as $characteristicDatum)
        {
            $characteristic = new Characteristic();
            $characteristic->name = $characteristicDatum['name'] ?? $this->faker->text(10);
            $characteristic->description = $characteristicDatum['description'] ?? $this->faker->text;
            $characteristic->game_id = $characteristicDatum['game_id'] ?? ArrayUtils::randomValue($games)->id;
            $characteristic->save();
        }

        $categoryData = JsonUtils::decodeFile(PathUtils::join(__DIR__, 'fixtures', 'attributes_fixtures.json'));
        foreach ($categoryData as $categoryDatum)
        {
            $category = new Category();
            $category->name = $categoryDatum['name'] ?? $this->faker->sentence(random_int(1, 2));
            $category->save();

            foreach ($categoryDatum['attributes'] ?? [] as $attributeDatum)
            {
                $attribute = new Attribute();
                $attribute->name = $attributeDatum['name'] ?? $this->faker->sentence(random_int(1, 3));
                if (array_key_exists('description', $attributeDatum))
                    $attribute->description = $attributeDatum['description'];
                else if ($this->faker->boolean)
                    $attribute->description = $this->faker->text;
                $attribute->game_id = $attributeDatum['game_id'] ?? $this->faker->randomElement($games);
                $attribute->type_value = AttributeTypeEnum::getVariables()[$attributeDatum['type_value'] ?? 'string'];
                $attribute->category_id = $category->id;
                $attribute->save();
                $attributes[] = $attribute;
            }

            foreach ($categoryDatum['structure_attributes'] ?? [] as $attributeDatum)
            {
                $attribute = new StructuralAttribute();
                $attribute->name = $attributeDatum['name'];
                $attribute->description = $this->faker->boolean ? null : $this->faker->sentence;
                $attribute->multiply = $attributeDatum['multiply'];
                $attribute->game_id = $attributeDatum['game_id'];
                $attribute->category_id = $category->id;
                $attribute->save();

                $fields = [];
                foreach ($attributeDatum['fields'] ?? [] as $structureColumn)
                {
                    $field = new StructureField();
                    $field->attribute_id = $attribute->id;
                    $field->name = $structureColumn['name'];
                    $field->type = $structureColumn['type'];
                    $field->save();
                    $fields[$structureColumn['slug']] = $field;
                }

                foreach ($attributeDatum['values'] ?? [] as $attributeValueDatum)
                {
                    $attributeValue = new StructuralAttributeValue();
                    $attributeValue->name = $attributeValueDatum['name'];
                    $attributeValue->description = $this->faker->boolean ? null : $this->faker->sentence;
                    $attributeValue->attribute_id = $attribute->id;
                    $attributeValue->save();

                    $fieldValues = $attributeValueDatum['field_values'] ?? [];
                    $valuesFields = $attributeValue->fieldsValues->keyBy('attribute_field_id');
                    foreach ($fieldValues as $slugField => $fieldValue)
                    {
                        $valueField = $valuesFields[$fields[$slugField]->id];
                        $valueField->value = $valueField->castValue($fieldValue);
                        $valueField->save();
                    }
                }
            }
        }

        foreach ($userIds as $userId)
        {
            foreach ($games as $game)
            {
                for ($i = random_int(5, 10); $i --> 0;)
                {
                    $hero = new Hero();
                    $hero->user_id = $userId;
                    $hero->name = $this->faker->sentence(2);
                    $hero->note = $this->faker->boolean ? null : $this->faker->text;
                    $hero->game_id = $game->id;
                    $hero->save();

                    /** @var Characteristic $characteristic */
                    foreach ($hero->game->characteristics as $characteristic)
                        $hero->characteristicValues()->updateExistingPivot($characteristic->id, ['value' => random_int(10, 100)], false);

                    /** @var Attribute $attribute */
                    foreach ($hero->game->attributeModels as $attribute)
                    {
                        $value = $this->faker->sentence(random_int(1, 2));
                        if ($attribute->type_value === AttributeTypeEnum::INT)
                            $value = random_int(0, 100);
                        else if ($attribute->type_value === AttributeTypeEnum::BOOL)
                            $value = $this->faker->boolean;
                        else if ($attribute->type_value === AttributeTypeEnum::DOUBLE)
                            $value = $this->faker->randomFloat(2, 0, 100);
                        $columnValue = sprintf('value_%s', AttributeTypeEnum::getValues()[$attribute->type_value] ?? 'string');
                        $hero->attributeValues()
                            ->where('attribute_id', $attribute->id)
                            ->update([$columnValue => $value]);
                    }

                    /** @var StructuralAttribute $attribute */
                    foreach ($hero->game->structuralAttributes as $attribute)
                    {
                        $heroAttributeValues = ArrayUtils::toArray($attribute->values()->pluck('id'));
                        $hero->structuralAttributeValues()->syncWithoutDetaching($attribute->multiply ? ArrayUtils::randomValues($heroAttributeValues) : [ArrayUtils::randomValue($heroAttributeValues)]);
                    }
                }
            }
        }
    }
}
