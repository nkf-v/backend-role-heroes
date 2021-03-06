<?php declare(strict_types=1);

namespace App\Providers;

use App\Models\Employee;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;
use Orchid\Platform\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register() : void
    {
        //
    }

    public function boot() : void
    {
        Dashboard::useModel(User::class, Employee::class);
    }

    // TODO create TD for dates
}
