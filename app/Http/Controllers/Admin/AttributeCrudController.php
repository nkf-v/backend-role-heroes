<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Models\AttributeCategory;
use App\Models\Game;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

/**
 * Class AttributeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AttributeCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel(Attribute::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/attribute');
        $this->crud->setEntityNameStrings('attribute', 'attributes');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns([
            'name',
            [
                'type' => 'model_function',
                'name' => 'type_value',
                'label' => 'Type value',
                'function_name' => 'getTypeValueLabel',
            ],
            'description',
            'category',
            'game',
        ]);
    }

    protected function setupShowOperation() : void
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumns([
            'created_at',
            'updated_at',
            'name',
            [
                'type' => 'model_function',
                'name' => 'type_value',
                'label' => 'Type value',
                'function_name' => 'getTypeValueLabel',
            ],
            'description',
            'category',
            'game',
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(AttributeRequest::class);

        $this->addFields();
    }

    protected function setupUpdateOperation()
    {
        $this->crud->setValidation(AttributeRequest::class);

        $this->addFields();
    }

    protected function addFields() : void
    {
        $this->crud->addFields([
            'name',
            [
                'type' => 'select2_from_array',
                'name' => 'type_value',
                'label' => 'Type value',
                'options' => Attribute::getTypeValueOptions(),
                'allows_null' => false,
                'default' => 0,
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
            [
                'type' => 'select2',
                'name' => 'category_id',
                'label' => 'Category',
                'entity' => 'category',
                'model' => AttributeCategory::class,
                'attribute' => 'name',
            ],
        ]);
    }
}
