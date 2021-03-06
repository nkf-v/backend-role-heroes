<?php declare(strict_types=1);

namespace App\Orchid\Screens\Hero;

use App\Models\Hero;
use App\Orchid\Layouts\Hero\HeroListLayout;
use Orchid\Screen\Screen;

class HeroListScreen extends Screen
{
    public $name = 'Heroes';

    public function query() : array
    {
        return [
            'heroes' => Hero::with(['game', 'user'])->paginate(10),
        ];
    }

    public function commandBar() : array
    {
        return [];
    }

    public function layout() : array
    {
        return [
            HeroListLayout::class,
        ];
    }
}
