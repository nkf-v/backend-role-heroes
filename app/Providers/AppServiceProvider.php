<?php declare(strict_types=1);

namespace App\Providers;

use App\Modules\Employees\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;
use Orchid\Platform\Models\User;
use Orchid\Screen\TD;

class AppServiceProvider extends ServiceProvider
{
    public function register() : void
    {
        //
    }

    public function boot() : void
    {
        Dashboard::useModel(User::class, Employee::class);

        $this->createTDMacros();
    }

    protected function createTDMacros() : void
    {
        TD::macro('date', function () : TD
        {
            /** @var string $column */
            $column = $this->column;

            $this->render(function ($datum) use ($column)
            {
                /** @var Carbon $value */
                $value = $datum->$column;
                return $value->format('d.m.Y');
            });

            return $this;
        });
    }
}
