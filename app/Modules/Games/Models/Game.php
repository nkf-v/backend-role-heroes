<?php declare(strict_types=1);

namespace App\Modules\Games\Models;

use App\Models\Attribute;
use App\Models\Characteristic;
use App\Models\Hero;
use App\Models\Item;
use App\Models\StructuralAttribute;
use App\Modules\Categories\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

class Game extends Model
{
    use AsSource;

    public $timestamps = true;

    public function categories() : HasMany { return $this->hasMany(Category::class); }
    public function heroes() : HasMany { return $this->hasMany(Hero::class); }
    public function characteristics() : HasMany { return $this->hasMany(Characteristic::class); }
    public function attributeModels() : HasMany { return $this->hasMany(Attribute::class); }
    public function structuralAttributes() : HasMany { return $this->hasMany(StructuralAttribute::class); }
    public function items() : HasMany { return $this->hasMany(Item::class); }
}
