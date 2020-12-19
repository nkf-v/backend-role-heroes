<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'name',
        'description',
    ];

    public function heroes() : HasMany
    {
        return $this->hasMany(UserHero::class);
    }
}
