<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

/**
 * @property int $attribute_id
 * @property string $name
 * @property int $type
 */
class Field extends Model
{
    use AsSource;

    public $timestamps = true;
    protected $table = 'structure_fields';

    protected static function boot()
    {
        parent::boot();

        self::created(function (self $field) : void
        {
            StructuralAttributeValue::where('attribute_id', $field->attribute_id)
                ->get()
                ->each(function (StructuralAttributeValue $value) use ($field) : void
                {
                    $fieldValue = new FieldValue();
                    $fieldValue->attribute_value_id = $value->id;
                    $fieldValue->attribute_field_id = $field->id;
                    $fieldValue->save();
                });
        });
    }

    public function attribute() : BelongsTo
    {
        return $this->belongsTo(StructuralAttribute::class, 'attribute_id');
    }

    public function selectOptions(): HasMany
    {
        return $this->hasMany(FieldSelectOption::class, 'field_id');
    }
}
