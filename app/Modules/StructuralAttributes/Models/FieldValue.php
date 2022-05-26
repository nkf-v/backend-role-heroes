<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Models;

use App\Traits\HasValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;

class FieldValue extends Model
{
    use HasValue;
    use AsSource;

    public $timestamps = true;
    protected $table = 'structural_field_values';
    protected $appends = ['value'];

    public function field() : BelongsTo { return $this->belongsTo(Field::class, 'attribute_field_id'); }

    public function getType() : int { return $this->field->type; }

    public function selectedOption(): BelongsTo
    {
        return $this->belongsTo(FieldSelectOption::class, 'value_select');
    }
}
