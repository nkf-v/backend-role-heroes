<?php

namespace App\Modules\Categories\Admin;

use App\Admin\OrchidAdmin;
use App\Modules\Categories\Admin\Orchid\Screens\CategoryEdit;
use App\Modules\Categories\Admin\Orchid\Screens\CategoryList;
use App\Modules\Categories\Models\Category;

class CategoryAdmin extends OrchidAdmin
{
    protected string $mainRoute = 'categories';
    protected string $mainRouteItem = 'category';
    protected string $listScreen = CategoryList::class;
    protected string $editScreen = CategoryEdit::class;

    protected string $model = Category::class;
}
