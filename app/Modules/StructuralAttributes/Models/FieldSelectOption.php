<?php

namespace App\Modules\StructuralAttributes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FieldSelectOption extends Model
{
    public $timestamps = true;
    protected $table = 'structure_field_select_options';

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class, 'field_id');
    }
}
