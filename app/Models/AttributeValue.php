<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\AttributeTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;

class AttributeValue extends Model
{
    use AsSource;

    public $table = 'heroes_attribute_values';
    public $timestamps = false;
    protected $appends = ['value'];

    public function attribute() : BelongsTo { return $this->belongsTo(Attribute::class); }

    public function getFiledValue() : string { return sprintf('value_%s', AttributeTypeEnum::getValues()[$this->attribute->type_value]); }

    public function getValueAttribute() { return $this->getAttribute($this->getFiledValue()); }
    public function setValueAttribute($value) : void { $this->setAttribute($this->getFiledValue(), $value); }
}
