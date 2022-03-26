<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\ValueTypeEnum;
use App\Enums\ItemTypeEnum;
use App\Models\Attribute;
use App\Models\Characteristic;
use App\Models\Employee;
use App\Modules\Categories\Models\Category;
use App\Modules\Games\Models\Game;
use App\Models\Hero;
use App\Models\Item;
use App\Models\ItemField;
use App\Modules\StructuralAttributes\Models\StructuralAttribute;
use App\Modules\StructuralAttributes\Models\StructuralAttributeValue;
use App\Modules\StructuralAttributes\Models\StructureField;
use App\Modules\StructuralAttributes\Models\StructuralAttributeValueGroup;
use App\Modules\Users\Models\User;
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
                $attribute->type_value = ValueTypeEnum::getVariables()[$attributeDatum['type_value'] ?? 'string'];
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

                $groupData = [];
                foreach ($attributeDatum['groups'] ?? [] as $groupDatum)
                {
                    $group = new StructuralAttributeValueGroup();
                    $group->name = $groupDatum['name'];
                    $group->attribute_id = $attribute->id;
                    $group->save();
                }

                $fieldData = [];
                foreach ($attributeDatum['fields'] ?? [] as $structureColumn)
                {
                    $field = new StructureField();
                    $field->attribute_id = $attribute->id;
                    $field->name = $structureColumn['name'];
                    $field->type = $structureColumn['type'];
                    $field->save();
                    $fieldData[$structureColumn['slug']] = $field;
                }

                foreach ($attributeDatum['values'] ?? [] as $attributeValueDatum)
                {
                    $attributeValue = new StructuralAttributeValue();
                    $attributeValue->name = $attributeValueDatum['name'];
                    $attributeValue->description = $this->faker->boolean ? null : $this->faker->sentence;
                    $attributeValue->attribute_id = $attribute->id;
                    $attributeValue->group_id = $attributeValueDatum['group_id'] ?? null;
                    $attributeValue->save();

                    $fieldValues = $attributeValueDatum['field_values'] ?? [];
                    $valuesFields = $attributeValue->fieldsValues->keyBy('attribute_field_id');
                    foreach ($fieldValues as $slugField => $fieldValue)
                    {
                        $valueField = $valuesFields[$fieldData[$slugField]->id];
                        $valueField->value = $valueField->castValue($fieldValue);
                        $valueField->save();
                    }
                }
            }
        }

        $gamesItems = JsonUtils::decodeFile(PathUtils::join(__DIR__, 'fixtures', 'items_fixtures.json'));
        $gameItemIds = [];
        foreach ($gamesItems as $gameItems)
        {
            $gameId = $gameItems['game_id'] ?? $this->faker->randomElement($games)->id;
            $typesItems = $gameItems['types'] ?? [];
            foreach ($typesItems as $typeItems)
            {
                $itemType = $typeItems['type'] ?? $this->faker->randomElement([ItemTypeEnum::WEAPON, ItemTypeEnum::ARMOR]);
                $fieldData = $typeItems['fields'] ?? [];
                $mapFieldIdToSlug = [];
                foreach ($fieldData as $fieldDatum)
                {
                    $field = new ItemField();
                    $field->game_id = $gameId;
                    $field->item_type = $itemType;
                    $field->name = $fieldDatum['name'];
                    $field->value_type = $fieldDatum['value_type'];
                    $field->save();
                    $mapFieldIdToSlug[$field->id] = $fieldDatum['slug'];
                }

                $itemData = $typeItems['items'] ?? [];
                foreach ($itemData as $itemDatum)
                {
                    $item = new Item();
                    $item->game_id = $gameId;
                    $item->type = $itemType;
                    $item->name = $itemDatum['name'];
                    $item->description = $this->faker->boolean ? null : $this->faker->text;
                    $item->save();
                    $gameItemIds[$gameId][] = $item->id;

                    foreach ($item->fieldValues as $fieldValue)
                    {
                        $fieldValue->value = $fieldValue->castValue($itemDatum['fields'][$mapFieldIdToSlug[$fieldValue->field_id]]);
                        $fieldValue->save();
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
                        if ($attribute->type_value === ValueTypeEnum::INT)
                            $value = random_int(0, 100);
                        else if ($attribute->type_value === ValueTypeEnum::BOOL)
                            $value = $this->faker->boolean;
                        else if ($attribute->type_value === ValueTypeEnum::DOUBLE)
                            $value = $this->faker->randomFloat(2, 0, 100);
                        $columnValue = sprintf('value_%s', ValueTypeEnum::getValues()[$attribute->type_value] ?? 'string');
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

                    $itemIds = [];
                    foreach ($hero->game->items as $item)
                        if ($this->faker->boolean)
                            $itemIds[] = $item->id;

                    $hero->items()->sync($itemIds);
                }
            }
        }
    }
}
