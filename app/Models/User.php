<?php declare(strict_types=1);

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use CrudTrait;

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
