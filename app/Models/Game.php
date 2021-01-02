<?php declare(strict_types=1);

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use CrudTrait;

    public $timestamps = true;
    protected $fillable = [
        'name',
        'description',
    ];

    public function heroes() : HasMany
    {
        return $this->hasMany(Hero::class);
    }

    public function characteristics() : HasMany
    {
        return $this->hasMany(Characteristic::class);
    }

    public function attributeModels() : HasMany
    {
        return $this->hasMany(Attribute::class);
    }
}
