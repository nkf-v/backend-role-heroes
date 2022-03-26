<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

class StructuralAttributeValue extends Model
{
    use AsSource;

    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();

        self::created(function (self $value) : void
        {
            StructureField::where('attribute_id', $value->attribute_id)
                ->get()
                ->each(function (StructureField $field) use ($value) : void
                {
                    $fieldValue = new StructuralFieldValue();
                    $fieldValue->attribute_value_id = $value->id;
                    $fieldValue->attribute_field_id = $field->id;
                    $fieldValue->save();
                });
        });
    }

    public function attribute() : BelongsTo
    {
        return $this->belongsTo(StructuralAttribute::class, 'attribute_id')
            ->with('fields');
    }

    public function group() : BelongsTo
    {
        return $this->belongsTo(StructuralAttributeValueGroup::class, 'group_id');
    }

    public function fieldsValues() : HasMany
    {
        return $this->HasMany(StructuralFieldValue::class, 'attribute_value_id')->with('field');
    }
}
