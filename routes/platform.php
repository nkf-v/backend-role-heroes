<?php declare(strict_types=1);

use App\Orchid\Screens\Employee\EmployeeEditScreen;
use App\Orchid\Screens\Employee\EmployeeListScreen;
use App\Orchid\Screens\Employee\EmployeeProfileScreen;
use App\Orchid\Screens\Game\GameEditScreen;
use App\Orchid\Screens\Game\GameListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserDetailScreen;
use App\Orchid\Screens\User\UserListScreen;
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

Route::screen('users', UserListScreen::class)
    ->name('platform.users')
    ->breadcrumbs(function (Trail $trail) : Trail
    {
        return $trail->push(__('Users'), route('platform.users'));
    });

Route::screen('user/{user}', UserDetailScreen::class)
    ->name('platform.users.detail')
    ->breadcrumbs(function (Trail $trail) : Trail
    {
        return $trail
            ->push(__('Users'), route('platform.users'))
            ->push(__('User'));
    });

Route::screen('games', GameListScreen::class)
    ->name('platform.games.list')
    ->breadcrumbs(function (Trail $trail) : Trail
    {
        return $trail
            ->push(__('Games'), route('platform.games.list'));
    });

Route::screen('game/{game?}', GameEditScreen::class)
    ->name('platform.games.edit');
