<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation { store as traitStore; }
    use UpdateOperation { update as traitUpdate; }
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel(User::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings('user', 'users');
    }

    protected function setupListOperation()
    {
        $this->crud->setColumns(['created_at', 'updated_at', 'login']);
    }

    protected function setupCreateOperation()
    {
        $this->addFields();
        $this->crud->setValidation(UserRequest::class);
    }

    public function store()
    {
        $this->handleRequest();
        return $this->traitStore();
    }

    protected function setupUpdateOperation()
    {
        $this->addFields();
        $this->crud->setValidation(UserRequest::class);
    }

    public function update()
    {
        $this->handleRequest();
        return $this->traitUpdate();
    }

    protected function setupShowOperation() : void
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumns(['created_at', 'updated_at', 'login']);
    }

    protected function addFields() : void
    {
        $this->crud->addFields([
            [
                'type' => 'text',
                'name' => 'login',
                'label' => 'Login',
            ],
            [
                'type' => 'password',
                'name' => 'password',
                'label' => 'Password',
            ],
            [
                'type' => 'password',
                'name' => 'password_confirmation',
            ],
        ]);
    }

    protected function handleRequest() : void
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->setRequest($this->updateRequest($this->crud->getRequest()));
        $this->crud->unsetValidation();
    }

    protected function updateRequest(UserRequest $request) : UserRequest
    {
        $request->request->remove('password_confirmation');
        $request->request->set('password', bcrypt($request->input('password')));
        return $request;
    }
}
