<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Models;

use App\Modules\Categories\Models\Category;
use App\Modules\Games\Models\Game;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

class StructuralAttribute extends Model
{
    use AsSource;

    public $timestamps = true;

    public function game() : BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function fields() : HasMany
    {
        return $this->hasMany(Field::class, 'attribute_id');
    }

    public function values() : HasMany
    {
        return $this->hasMany(StructuralAttributeValue::class, 'attribute_id')
            ->with(['fieldsValues', 'group']);
    }
}
