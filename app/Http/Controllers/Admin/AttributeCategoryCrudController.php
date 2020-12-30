<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AttributeCategoryRequest;
use App\Models\Attribute;
use App\Models\AttributeCategory;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

/**
 * Class AttributeCategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AttributeCategoryCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel(AttributeCategory::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/attributecategory');
        $this->crud->setEntityNameStrings('attributecategory', 'attribute_categories');
    }

    protected function setupListOperation()
    {
        $this->crud->setColumns([
            'name',
            [
                'type' => 'relationship',
                'name' => 'attributes',
                'label' => 'Attributes',
                'entity' => 'attributes',
                'attribute' => 'name',
                'model' => Attribute::class,
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(AttributeCategoryRequest::class);

        $this->addFields();
    }

    protected function setupShowOperation() : void
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumns([
            'created_at',
            'updated_at',
            'name',
            [
                'type' => 'relationship',
                'name' => 'attributes',
                'label' => 'Attributes',
                'entity' => 'attributes',
                'attribute' => 'name',
                'model' => Attribute::class,
            ]
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->addFields();
    }

    protected function addFields() : void
    {
        $this->crud->addFields([
            'name',
            // TODO create change category to attribute
        ]);
    }
}
