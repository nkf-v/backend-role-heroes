<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();

        self::created(function (self $item) : void
        {
            ItemField::query()
                ->where('game_id', $item->game_id)
                ->where('item_type', $item->attribute_id)
                ->get()
                ->each(function (ItemField $field) use ($item) : void
                {
                    $fieldValue = new ItemFieldValue();
                    $fieldValue->item_id = $item->id;
                    $fieldValue->field_id = $field->id;
                    $fieldValue->save();
                });
        });
    }

    public function game() : BelongsTo { return $this->belongsTo(Game::class); }
    public function user() : BelongsTo { return $this->belongsTo(User::class); }
    public function fieldValues() : HasMany { return $this->hasMany(ItemFieldValue::class)->with('field'); }
}
