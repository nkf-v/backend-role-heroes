<?php declare(strict_types=1);

namespace App\Models;

use App\Formatters\Admin\AttributeValueFormatter;
use App\Formatters\Admin\CharacteristicValueFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hero extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'name',
        'note',
        'game_id',
        'user_Id',
    ];

    protected static function boot()
    {
        parent::boot();

        self::created(function (self $hero) : void
        {
            $hero->characteristicValues()->sync($hero->game->characteristics);
            Attribute::whereGameId($hero->game_id)
                ->get()
                ->each(function (Attribute $attribute) use ($hero) : void
                {
                    $attributeValue = new AttributeValue();
                    $attributeValue->hero_id = $hero->id;
                    $attributeValue->attribute_id = $attribute->id;
                    $attributeValue->save();
                });
        });
    }


    public function game() : BelongsTo { return $this->belongsTo(Game::class); }
    public function user() : BelongsTo { return $this->belongsTo(User::class); }

    public function characteristicValues() : BelongsToMany
    {
        return $this->belongsToMany(Characteristic::class, 'heroes_characteristics', 'hero_id')
            ->withPivot('value')
            ->where('game_id', $this->game_id);
    }
    public function attributeValues() : HasMany { return $this->hasMany(AttributeValue::class, 'hero_id')->with('attribute'); }

    public function getTableCharacteristicValuesAttribute() : array { return app(CharacteristicValueFormatter::class)->formatList($this->characteristicValues); }
    public function getTableAttributeValuesAttribute() : array { return app(AttributeValueFormatter::class)->formatList($this->attributeValues); }
}
