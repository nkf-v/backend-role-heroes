<?php declare(strict_types=1);

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use CrudTrait;
    use Notifiable;

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

    public function getJWTIdentifier() { return $this->getKey(); }

    public function getJWTCustomClaims() : array { return []; }
}
