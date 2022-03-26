<?php declare(strict_types=1);

namespace App\Modules\Games\Admin\Orchid\Screens;

use Alert;
use App\Modules\Games\Admin\Orchid\Layouts\GameRows;
use App\Modules\Games\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class GameEdit extends Screen
{
    public $name = 'Create game';
    public bool $exist;

    public function query(?Game $game) : array
    {
        if ($game === null)
            abort(Response::HTTP_NOT_FOUND);
        $this->exist = $game->exists;
        if ($this->exist)
            $this->name = $game->name;
        return [
            'game' => $game,
        ];
    }

    /**
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create')
                ->icon('plus')
                ->method('createOrUpdate')
                ->canSee(!$this->exist),
            Button::make('Update')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee($this->exist),
            Button::make('Delete')
                ->icon('trash')
                ->method('delete')
                ->canSee($this->exist),
        ];
    }

    /**
     * @return Layout[]
     */
    public function layout() : array
    {
        return [
            new GameRows(!$this->exist),
        ];
    }

    protected function createOrUpdate(Game $game, Request $request) : RedirectResponse
    {
        $gameData = $request->get('game');
        $game->name = $gameData['name'];
        $game->description = $gameData['description'];
        $game->save();

        Alert::info('Games success save');

        return redirect()->route('platform.games.edit', $game);
    }

    protected function delete(Game $game) : RedirectResponse
    {
        $game->delete();

        Alert::info('Games success delete');

        return redirect()->route('platform.games.list');
    }
}
