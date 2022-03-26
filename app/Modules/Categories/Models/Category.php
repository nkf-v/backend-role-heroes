<?php declare(strict_types=1);

namespace App\Modules\Categories\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

// TODO add sort_order or position
class Category extends Model
{
    use AsSource;

    public $timestamps = true;
}
