<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

// TODO add sort_order or position
class Category extends Model
{
    use AsSource;

    public $timestamps = true;

    public function attributes() : HasMany { return $this->hasMany(Attribute::class, 'category_id'); }
}
