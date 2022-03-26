<?php declare(strict_types=1);

namespace App\Modules\Users\Models;

use App\Models\Hero;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Orchid\Screen\AsSource;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, AsSource;

    public $timestamps = true;

    public function heroes() : HasMany { return $this->hasMany(Hero::class); }

    public function getJWTIdentifier() { return $this->getKey(); }

    public function getJWTCustomClaims() : array { return []; }
}
