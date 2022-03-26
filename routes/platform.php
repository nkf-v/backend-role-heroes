<?php declare(strict_types=1);

use App\Models\Characteristic;
use App\Models\StructuralAttribute;
use App\Models\StructuralAttributeValue;
use App\Models\User;
use App\Orchid\Screens\Attribute\AttributeEditScreen;
use App\Orchid\Screens\Attribute\AttributeListScreen;
use App\Orchid\Screens\Characteristic\CharacteristicEditScreen;
use App\Orchid\Screens\Characteristic\CharacteristicListScreen;
use App\Orchid\Screens\Employee\EmployeeEditScreen;
use App\Orchid\Screens\Employee\EmployeeListScreen;
use App\Orchid\Screens\Employee\EmployeeProfileScreen;
use App\Orchid\Screens\Hero\HeroDetailScreen;
use App\Orchid\Screens\Hero\HeroListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\StructuralAttribute\StructuralAttributeEditScreen;
use App\Orchid\Screens\StructuralAttribute\StructuralAttributeListScreen;
use App\Orchid\Screens\StructuralAttributeValue\StructuralAttributeValueEditScreen;
use App\Orchid\Screens\StructuralAttributeValue\StructuralAttributeValueListScreen;
use App\Orchid\Screens\StructureField\StructureFieldEditScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', EmployeeProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Employees
Route::screen('employees/{employees}/edit', EmployeeEditScreen::class)
    ->name('platform.systems.employees.edit')
    ->breadcrumbs(function (Trail $trail, $employee) {
        return $trail
            ->parent('platform.systems.employees')
            ->push(__('Edit'), route('platform.systems.employees.edit', $employee));
    });

// Platform > System > Employees > Employee
Route::screen('employees', EmployeeListScreen::class)
    ->name('platform.systems.employees')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.index')
            ->push(__('Users'), route('platform.systems.employees'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{roles}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) : Trail
    {
        return $trail
            ->parent('platform.systems.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Custom routes

Route::screen('characteristics', CharacteristicListScreen::class)
    ->name('platform.characteristics.list')
    ->breadcrumbs(function (Trail $trail) : Trail
    {
        return $trail
            ->push(__('Characteristics'), route('platform.characteristics.list'));
    });

Route::screen('characteristic/{characteristic?}', CharacteristicEditScreen::class)
    ->name('platform.characteristics.edit')
    ->breadcrumbs(function (Trail $trail, ?int $characteristicId = null) : Trail
    {
        $name = 'Characteristic';
        if ($characteristicId !== null)
        {
            $game = Characteristic::find($characteristicId);
            if ($game !== null)
                $name = $game->name;
        }

        return $trail
            ->push(__('Characteristics'), route('platform.characteristics.list'))
            ->push($name);
    });

Route::screen('attributes', AttributeListScreen::class)
    ->name('platform.attributes.list')
    ->breadcrumbs(function (Trail $trail) : Trail
    {
        return $trail
            ->push(__('Attributes'), route('platform.attributes.list'));
    });

Route::screen('attribute/{attribute?}', AttributeEditScreen::class)
    ->name('platform.attributes.edit')
    ->breadcrumbs(function (Trail $trail) : Trail
    {
        return $trail
            ->push(__('Attributes'), route('platform.attributes.list'))
            ->push(__('Attribute'));
    });

Route::screen('structural_attributes', StructuralAttributeListScreen::class)
    ->name('platform.structural_attributes.list')
    ->breadcrumbs(function (Trail $trail) : Trail
    {
        return $trail
            ->push(__('Structural attributes'), route('platform.structural_attributes.list'));
    });

Route::screen('structural_attribute/{attribute?}', StructuralAttributeEditScreen::class)
    ->name('platform.structural_attributes.edit')
    ->breadcrumbs(function (Trail $trail, ?int $attributeId = null) : Trail
    {
        $attributeName = 'Attribute';
        if ($attributeId !== null)
        {
            $attribute = StructuralAttribute::find($attributeId);
            $attributeName = $attribute->name;
        }

        return $trail
            ->push(__('Structural attributes'), route('platform.structural_attributes.list'))
            ->push(__($attributeName));
    });

Route::screen('structure_field/{field}', StructureFieldEditScreen::class)
    ->name('platform.structure_fields.edit')
    ->breadcrumbs(function (Trail $trail) : Trail
    {
        return $trail->push(__('Structure field'));
    });

Route::screen('structural_attribute/{attribute}/values', StructuralAttributeValueListScreen::class)
    ->name('platform.structural_attribute_values.list')
    ->breadcrumbs(function (Trail $trail, int $attributeId) : Trail
    {
        $attribute = StructuralAttribute::find($attributeId);

        return $trail
            ->push(__('Structural attributes'), route('platform.structural_attributes.list'))
            ->push($attribute->name, route('platform.structural_attributes.edit', $attributeId))
            ->push(__('Values'));
    });

Route::screen('structural_attribute/{attribute}/value/{value?}', StructuralAttributeValueEditScreen::class)
    ->name('platform.structural_attribute_values.edit')
    ->breadcrumbs(function (Trail $trail, int $attributeId, ?int $valueId = null) : Trail
    {
        $attribute = StructuralAttribute::find($attributeId);
        $valueName = 'Value';
        if ($valueId !== null)
            $valueName = StructuralAttributeValue::find($valueId)->name;

        return $trail
            ->push(__('Structural attributes'), route('platform.structural_attributes.list'))
            ->push($attribute->name, route('platform.structural_attributes.edit', $attributeId))
            ->push(__('Values'), route('platform.structural_attribute_values.list', ['attribute' => $attributeId]))
            ->push(__($valueName));
    });

Route::screen('heroes', HeroListScreen::class)
    ->name('platform.heroes.list')
    ->breadcrumbs(function (Trail $trail) : Trail
    {
        return $trail
            ->push(__('Heroes'));
    });

Route::screen('hero/{hero}', HeroDetailScreen::class)
    ->name('platform.heroes.detail')
    ->breadcrumbs(function (Trail $trail) : Trail
    {
        return $trail
            ->push(__('Heroes'), route('platform.heroes.list'))
            ->push(__('Hero'));
    });


Route::fallback(function () { return 'error'; });
