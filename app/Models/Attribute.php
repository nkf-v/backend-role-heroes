<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\AttributeTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;

class Attribute extends Model
{
    use AsSource;

    public $timestamps = true;

    public function game() : BelongsTo { return $this->belongsTo(Game::class); }
    public function category() : BelongsTo { return $this->belongsTo(Category::class, 'category_id'); }
}
