<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\AttributeTypeEnum;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attribute extends Model
{
    use CrudTrait;

    public $timestamps = true;
    public $fillable = [
        'name',
        'description',
        'category_id',
        'game_id',
        'type_value',
    ];

    public function game() : BelongsTo { return $this->belongsTo(Game::class); }
    public function category() : BelongsTo { return $this->belongsTo(AttributeCategory::class, 'category_id'); }

    static public function getTypeValueOptions() : array { return AttributeTypeEnum::getLabels(); }

    public function getTypeValueLabel() : string { return AttributeTypeEnum::getLabelValue($this->type_value); }
}
