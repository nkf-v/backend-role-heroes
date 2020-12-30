<?php declare(strict_types=1);

namespace App\Models;

use App\Formatters\AttributeValueFormatter;
use App\Formatters\CharacteristicValueFormatter;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserHero extends Model
{
    use CrudTrait;

    public $timestamps = true;
    protected $fillable = [
        'name',
        'note',
        'game_id',
        'user_Id',
    ];

    public function game() : BelongsTo { return $this->belongsTo(Game::class); }
    public function user() : BelongsTo { return $this->belongsTo(User::class); }

    public function characteristicValues() : BelongsToMany { return $this->belongsToMany(Characteristic::class, 'user_heroes_characteristics', 'hero_id', null)->withPivot(['value'])->where('game_id', $this->game_id); }
    public function attributeValues() : HasMany { return $this->hasMany(AttributeValue::class, 'hero_id'); }

    public function getCharacteristicValuesAttribute() : array { return app(CharacteristicValueFormatter::class)->formatList($this->characteristicValues()->get()); }
    public function getAttributeValuesAttribute() : array { return app(AttributeValueFormatter::class)->formatList($this->attributeValues()->get()); }
}
