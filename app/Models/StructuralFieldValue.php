<?php declare(strict_types=1);

namespace App\Models;

use App\Traits\HasValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;

class StructuralFieldValue extends Model
{
    use HasValue;
    use AsSource;

    public $timestamps = true;
    protected $appends = ['value'];

    public function field() : BelongsTo { return $this->belongsTo(StructureField::class, 'attribute_field_id'); }

    public function getType() : int { return $this->field->type; }
}
