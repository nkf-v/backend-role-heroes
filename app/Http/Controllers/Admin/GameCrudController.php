<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GameRequest;
use App\Models\Attribute;
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
 * Class GameCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class GameCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel(Game::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/game');
        $this->crud->setEntityNameStrings('game', 'games');
    }

    protected function setupListOperation()
    {
        $this->crud->setColumns(['created_at', 'updated_at', 'name', 'description']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(GameRequest::class);

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
                'name' => 'characteristics',
                'label' => 'Characteristics',
                'entity' => 'characteristics',
                'attribute' => 'name',
                'model' => Characteristic::class,
            ],
            [
                'type' => 'relationship',
                'name' => 'attributeModels',
                'label' => 'Attributes',
                'entity' => 'attributeModels',
                'attribute' => 'name',
                'model' => Attribute::class,
            ],
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
        ]);
    }
}
