<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;

class StructureField extends Model
{
    use AsSource;

    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();

        self::created(function (self $field) : void
        {
            StructuralAttributeValue::where('attribute_id', $field->attribute_id)
                ->get()
                ->each(function (StructuralAttributeValue $value) use ($field) : void
                {
                    $fieldValue = new StructuralFieldValue();
                    $fieldValue->attribute_value_id = $value->id;
                    $fieldValue->attribute_field_id = $field->id;
                    $fieldValue->save();
                });
        });
    }

    public function attribute() : BelongsTo { return $this->belongsTo(StructuralAttribute::class, 'attribute_id'); }
}
