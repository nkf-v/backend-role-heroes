<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserHeroRequest;
use App\Models\Characteristic;
use App\Models\Game;
use App\Models\UserHero;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Log;

/**
 * Class UserHeroCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserHeroCrudController extends CrudController
{
    use ListOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel(UserHero::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/userhero');
        $this->crud->setEntityNameStrings('userhero', 'heroes');
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
            'name',
            'game',
            [
                'type' => 'table',
                'name' => 'characteristic_values',
                'label' => 'Characteristics',
                'columns' => [
                    'name' => 'Name',
                    'value' => 'Value',
                ],
            ],
            'note',
        ]);
    }
}
