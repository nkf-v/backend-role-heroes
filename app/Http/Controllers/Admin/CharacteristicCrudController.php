<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CharacteristicRequest;
use App\Models\Characteristic;
use App\Models\Game;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CharacteristicCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CharacteristicCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel(Characteristic::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/characteristic');
        $this->crud->setEntityNameStrings('characteristic', 'characteristics');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns([
            'created_at',
            'updated_at',
            'name',
            'description',
            [
                'type' => 'relationship',
                'name' => 'game',
                'label' => 'Game',
                'entity' => 'game',
                'attribute' => 'name',
                'model' => Game::class,
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(CharacteristicRequest::class);

        $this->addFields();
    }

    protected function setupUpdateOperation()
    {
        $this->addFields();
    }

    protected function setupShowOperation() : void
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumns([
            'created_at',
            'updated_at',
            'name',
            'description',
            [
                'type' => 'relationship',
                'name' => 'game',
                'label' => 'Game',
                'entity' => 'game',
                'attribute' => 'name',
                'model' => Game::class,
            ]
        ]);
    }

    protected function addFields() : void
    {
        $this->crud->addFields([
            [
                'type' => 'text',
                'name' => 'name',
                'label' => 'Name',
            ],
            [
                'type' => 'textarea',
                'name' => 'description',
                'label' => 'Description',
            ],
            [
                'type' => 'select2',
                'name' => 'game_id',
                'label' => 'Game',
                'entity' => 'game',
                'model' => Game::class,
                'attribute' => 'name',
            ],
        ]);
    }
}
