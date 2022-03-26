<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Attribute
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $type_value
 * @property int $game_id
 * @property int|null $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Categories\Models\Category|null $category
 * @property-read \App\Modules\Games\Models\Game $game
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereTypeValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereUpdatedAt($value)
 */
	class Attribute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AttributeValue
 *
 * @property int $id
 * @property int $attribute_id
 * @property int $hero_id
 * @property int|null $value_int
 * @property string|null $value_string
 * @property bool|null $value_bool
 * @property float|null $value_double
 * @property-read \App\Models\Attribute $attribute
 * @property mixed $value
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereHeroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereValueBool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereValueDouble($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereValueInt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue whereValueString($value)
 */
	class AttributeValue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Characteristic
 *
 * @property int $id
 * @property string $name
 * @property int $game_id
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Games\Models\Game $game
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereUpdatedAt($value)
 */
	class Characteristic extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Employee
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property array|null $permissions
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Orchid\Platform\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User countByDays($startDate = null, $stopDate = null, string $dateColumn = 'created_at')
 * @method static \Illuminate\Database\Eloquent\Builder|User countForGroup(string $groupColumn)
 * @method static \Illuminate\Database\Eloquent\Builder|User defaultSort(string $column, string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|User filters(?\Orchid\Filters\HttpFilter $httpFilter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User filtersApply(array $filters = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User filtersApplySelection($selection)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder|User sumByDays(string $value, $startDate = null, $stopDate = null, string $dateColumn = 'created_at')
 * @method static \Illuminate\Database\Eloquent\Builder|User valuesByDays(string $value, $startDate = null, $stopDate = null, string $dateColumn = 'created_at')
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereUpdatedAt($value)
 */
	class Employee extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Hero
 *
 * @property int $id
 * @property string $name
 * @property int $game_id
 * @property int $user_id
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttributeValue[] $attributeValues
 * @property-read int|null $attribute_values_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Characteristic[] $characteristicValues
 * @property-read int|null $characteristic_values_count
 * @property-read \App\Modules\Games\Models\Game $game
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StructuralAttributeValue[] $structuralAttributeValues
 * @property-read int|null $structural_attribute_values_count
 * @property-read \App\Modules\Users\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Hero newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hero newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hero query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hero whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hero whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hero whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hero whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hero whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hero whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hero whereUserId($value)
 */
	class Hero extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Item
 *
 * @property int $id
 * @property int $game_id
 * @property int $type
 * @property string $name
 * @property string|null $description
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemFieldValue[] $fieldValues
 * @property-read int|null $field_values_count
 * @property-read \App\Modules\Games\Models\Game $game
 * @property-read \App\Modules\Users\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUserId($value)
 */
	class Item extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemField
 *
 * @property int $id
 * @property int $game_id
 * @property int $item_type
 * @property string $name
 * @property int $value_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Games\Models\Game $game
 * @method static \Illuminate\Database\Eloquent\Builder|ItemField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemField query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemField whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemField whereItemType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemField whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemField whereValueType($value)
 */
	class ItemField extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemFieldValue
 *
 * @property int $id
 * @property int $item_id
 * @property int $field_id
 * @property int|null $value_int
 * @property string|null $value_string
 * @property bool|null $value_bool
 * @property float|null $value_double
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ItemField $field
 * @property mixed $value
 * @method static \Illuminate\Database\Eloquent\Builder|ItemFieldValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemFieldValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemFieldValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemFieldValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemFieldValue whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemFieldValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemFieldValue whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemFieldValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemFieldValue whereValueBool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemFieldValue whereValueDouble($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemFieldValue whereValueInt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemFieldValue whereValueString($value)
 */
	class ItemFieldValue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StructuralAttribute
 *
 * @property int $id
 * @property bool $multiply
 * @property string $name
 * @property string|null $description
 * @property int $game_id
 * @property int|null $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Categories\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StructureField[] $fields
 * @property-read int|null $fields_count
 * @property-read \App\Modules\Games\Models\Game $game
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StructuralAttributeValue[] $values
 * @property-read int|null $values_count
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttribute whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttribute whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttribute whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttribute whereMultiply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttribute whereUpdatedAt($value)
 */
	class StructuralAttribute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StructuralAttributeValue
 *
 * @property int $id
 * @property int $attribute_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\StructuralAttribute $attribute
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StructuralFieldValue[] $fieldsValues
 * @property-read int|null $fields_values_count
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttributeValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttributeValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttributeValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttributeValue whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttributeValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttributeValue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttributeValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttributeValue whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralAttributeValue whereUpdatedAt($value)
 */
	class StructuralAttributeValue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StructuralFieldValue
 *
 * @property int $id
 * @property int $attribute_value_id
 * @property int $attribute_field_id
 * @property int|null $value_int
 * @property string|null $value_string
 * @property bool|null $value_bool
 * @property float|null $value_double
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\StructureField $field
 * @property mixed $value
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralFieldValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralFieldValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralFieldValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralFieldValue whereAttributeFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralFieldValue whereAttributeValueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralFieldValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralFieldValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralFieldValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralFieldValue whereValueBool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralFieldValue whereValueDouble($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralFieldValue whereValueInt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralFieldValue whereValueString($value)
 */
	class StructuralFieldValue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StructureField
 *
 * @property int $id
 * @property int $attribute_id
 * @property string $name
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\StructuralAttribute $attribute
 * @method static \Illuminate\Database\Eloquent\Builder|StructureField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StructureField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StructureField query()
 * @method static \Illuminate\Database\Eloquent\Builder|StructureField whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructureField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructureField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructureField whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructureField whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructureField whereUpdatedAt($value)
 */
	class StructureField extends \Eloquent {}
}

namespace App\Modules\Categories\Models{
/**
 * App\Modules\Categories\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $game_id
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Modules\Games\Models{
/**
 * App\Modules\Games\Models\Game
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attribute[] $attributeModels
 * @property-read int|null $attribute_models_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Categories\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Characteristic[] $characteristics
 * @property-read int|null $characteristics_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Hero[] $heroes
 * @property-read int|null $heroes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StructuralAttribute[] $structuralAttributes
 * @property-read int|null $structural_attributes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereUpdatedAt($value)
 */
	class Game extends \Eloquent {}
}

namespace App\Modules\Users\Models{
/**
 * App\Modules\Users\Models\User
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Hero[] $heroes
 * @property-read int|null $heroes_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject {}
}

