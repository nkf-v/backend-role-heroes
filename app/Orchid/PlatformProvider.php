<?php

namespace App\Orchid;

use Orchid\Platform\ItemMenu;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @return ItemMenu[]
     */
    public function registerMainMenu(): array
    {
        return [
            ItemMenu::label(__('Games'))
                ->route('platform.games.list')
                ->icon('notebook')
                ->title('Content'),
            ItemMenu::label(__('Categories'))
                ->route('platform.categories.list')
                ->icon('browser'),
            ItemMenu::label(__('Characteristics'))
                ->route('platform.characteristics.list')
                ->icon('list'),
            ItemMenu::label(__('Attributes'))
                ->route('platform.attributes.list')
                ->icon('grid'),
            ItemMenu::label(__('Structural attributes'))
                ->route('platform.structural_attributes.list')
                ->icon('grid'),
            ItemMenu::label(__('Users'))
                ->route('platform.users.list')
                ->icon('user')
                ->title(__('User data')),
            ItemMenu::label(__('Heroes'))
                ->route('platform.heroes.list')
                ->icon('friends'),
        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            ItemMenu::label('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerSystemMenu(): array
    {
        return [
            ItemMenu::label(__('Access rights'))
                ->icon('lock')
                ->slug('Auth')
                ->active('platform.systems.*')
                ->permission('platform.systems.index')
                ->sort(1000),

            ItemMenu::label(__('Users'))
                ->place('Auth')
                ->icon('user')
                ->route('platform.systems.employees')
                ->permission('platform.systems.employees')
                ->sort(1000)
                ->title(__('All registered employees')),

            ItemMenu::label(__('Roles'))
                ->place('Auth')
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->sort(1000)
                ->title(__('A Role defines a set of tasks a user assigned the role is allowed to perform.')),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('Systems'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.employees', __('Employees')),
        ];
    }

    /**
     * @return string[]
     */
    public function registerSearchModels(): array
    {
        return [
            // ...Models
            // \App\Models\User::class
        ];
    }
}
