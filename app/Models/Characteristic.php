<?php declare(strict_types=1);

namespace App\Models;

use App\Modules\Games\Models\Game;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;

class Characteristic extends Model
{
    use AsSource;

    public $timestamps = true;

    public function game() : BelongsTo { return $this->belongsTo(Game::class); }
}
