<?php

namespace App\Modules\StructuralAttributes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StructuralAttributeValueGroup extends Model
{
    public $timestamps = true;

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(StructuralAttribute::class, 'attribute_id');
    }

    public function values(): HasMany
    {
        return $this->hasMany(StructuralAttributeValue::class, 'group_id');
    }
}
