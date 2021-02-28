<?php declare(strict_types=1);

namespace App\Orchid\Screens\Characteristic;

use App\Models\Characteristic;
use App\Orchid\Layouts\Characteristic\CharacteristicEditRows;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class CharacteristicEditScreen extends Screen
{
    public $name = 'Characteristic';
    protected bool $exist;

    public function query(Characteristic $characteristic) : array
    {
        $this->exist = $characteristic->exists;
        if ($this->exist)
            $this->name = $characteristic->name;

        return [
            'characteristic' => $characteristic,
        ];
    }

    public function commandBar() : array
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

    public function layout() : array
    {
        return [
            new CharacteristicEditRows(!$this->exist),
        ];
    }

    protected function createOrUpdate(Characteristic $characteristic, Request $request) : RedirectResponse
    {
        $characteristicData = $request->get('characteristic');
        $characteristic->name = $characteristicData['name'];
        $characteristic->game_id = $characteristicData['game_id'];
        $characteristic->description = $characteristicData['description'];
        $characteristic->save();

        Alert::success('Characteristic saved');

        return redirect(route('platform.characteristics.edit', $characteristic));
    }

    protected function delete(Characteristic $characteristic) : RedirectResponse
    {
        $characteristic->delete();

        Alert::success('Characteristic deleted');

        return redirect(route('platform.characteristics.list'));
    }
}
