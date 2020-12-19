<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $timestamps = true;
    protected $fillable = [
        'login',
        'password',
    ];

    protected $hidden = ['password'];

    public function heroes() : HasMany
    {
        return $this->hasMany(UserHero::class);
    }
}
