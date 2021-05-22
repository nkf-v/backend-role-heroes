<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\AttributeTypeEnum;
use App\Traits\HasValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;

class AttributeValue extends Model
{
    use AsSource;
    use HasValue;

    public $table = 'heroes_attribute_values';
    public $timestamps = false;
    protected $appends = ['value'];

    public function attribute() : BelongsTo { return $this->belongsTo(Attribute::class); }

    public function getType(): int
    {
        return $this->attribute->type_value;
    }
}
