<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemField extends Model
{
    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();

        self::created(function (self $field) : void
        {
            Item::query()
                ->where('type', $field->item_type)
                ->where('game_id', $field->game_id)
                ->get()
                ->each(function (Item $item) use ($field) : void
                {
                    $fieldValue = new ItemFieldValue();
                    $fieldValue->item_id = $item->id;
                    $fieldValue->field_id = $field->id;
                    $fieldValue->save();
                });
        });
    }

    public function game() : BelongsTo { return $this->belongsTo(Game::class); }
}
