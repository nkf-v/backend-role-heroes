<?php declare(strict_types=1);

namespace App\Models;

use App\Traits\HasValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemFieldValue extends Model
{
    use HasValue;

    public $timestamps = true;
    protected $appends = ['value'];

    public function field() : BelongsTo { return $this->belongsTo(ItemField::class, 'field_id'); }
    public function getType() : int { return $this->field->value_type; }
}
