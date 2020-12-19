<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    public $timestamps = true;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = ['password'];
}
