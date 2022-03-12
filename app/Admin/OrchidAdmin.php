<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\Screen;
use Route;
use Tabuna\Breadcrumbs\Trail;

abstract class OrchidAdmin implements AdminBase
{
    protected string $mainRoute = 'items';
    protected string $mainRouteItem = 'item';

    protected string $listScreen = Screen::class;
    protected string $detailScreen = Screen::class;

    protected string $model = Model::class;

    public function initRoutes() : void
    {
        Route::screen($this->mainRoute, $this->listScreen)
            ->name(sprintf('platform.%s.list', $this->mainRoute))
            ->breadcrumbs(function (Trail $trail) : Trail
            {
                return $trail->push(__($this->mainRoute));
            });

        Route::screen(sprintf('%s/{id?}', $this->mainRouteItem), $this->detailScreen)
            ->name(sprintf('platform.%s.edit', $this->mainRoute))
            ->breadcrumbs(function (Trail $trail, ?int $id = null) : Trail
            {
                $name = __($this->mainRouteItem);
                if ($id !== null)
                {
                    $model = ($this->model)::find($id);
                    if ($model !== null)
                        $name = $model->name ?? $name;
                }

                return $trail->push(__($this->mainRoute))
                    ->push($name);
            });
    }
}
