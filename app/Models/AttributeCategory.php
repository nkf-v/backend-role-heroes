<?php declare(strict_types=1);

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// TODO add sort_order or position
class AttributeCategory extends Model
{
    use CrudTrait;

    public $timestamps = true;
    protected $guarded = ['id'];
    protected $fillable = ['name'];

    public function attributes() : HasMany { return $this->hasMany(Attribute::class, 'category_id'); }
}
