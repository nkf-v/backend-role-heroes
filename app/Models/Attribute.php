<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\AttributeTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attribute extends Model
{
    public $timestamps = true;
    public $fillable = [
        'name',
        'description',
        'category_id',
        'game_id',
        'type_value',
    ];

    public function game() : BelongsTo { return $this->belongsTo(Game::class); }
    public function category() : BelongsTo { return $this->belongsTo(Category::class, 'category_id'); }

    static public function getTypeValueOptions() : array { return AttributeTypeEnum::getLabels(); }

    public function getTypeValueLabel() : string { return AttributeTypeEnum::getLabelValue($this->type_value); }
}
