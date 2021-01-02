<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Hero;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

/**
 * Class UserHeroCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class HeroCrudController extends CrudController
{
    use ListOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel(Hero::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/hero');
        $this->crud->setEntityNameStrings('hero', 'heroes');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns([
            'created_at',
            'updated_at',
            'name',
            'game',
        ]);
    }

    protected function setupShowOperation() : void
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumns([
            'created_at',
            'updated_at',
            [
                'type' => 'relationship',
                'name' => 'user',
                'label' => 'User',
                'entity' => 'user',
                'model' => User::class,
                'attribute' => 'login',
            ],
            'name',
            'game',
            'note',
            [
                'type' => 'table',
                'name' => 'table_characteristic_values',
                'label' => 'Characteristics',
                'columns' => [
                    'name' => 'Name',
                    'value' => 'Value',
                ],
            ],
            [
                'type' => 'table',
                'name' => 'table_attribute_values',
                'label' => 'Attributes',
                'columns' => [
                    'name' => 'Name',
                    'type_value' => 'Type',
                    'value' => 'Value',
                ],
            ],
        ]);
    }
}
