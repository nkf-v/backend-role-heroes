<?php

namespace App\Providers;

use App\Admin\AdminBase;
use App\Modules\Categories\Admin\CategoryAdmin;
use App\Modules\Games\Admin\GameAdmin;
use Illuminate\Support\Facades\Route;
use Orchid\Platform\Dashboard;
use Orchid\Platform\Providers\RouteServiceProvider as ServiceProvider;

class AdminProvider extends ServiceProvider
{
    protected array $crudClasses = [
        GameAdmin::class,
        CategoryAdmin::class,
    ];

    public function map() : void
    {
        parent::map();

        Route::domain((string) config('platform.domain'))
            ->prefix(Dashboard::prefix('/'))
            ->middleware(config('platform.middleware.private'))
            ->group(function () {
                foreach ($this->crudClasses as $class)
                {
                    /** @var AdminBase $crud */
                    $crud = $this->app->make($class);
                    $crud->initRoutes();
                }
            });
    }
}
