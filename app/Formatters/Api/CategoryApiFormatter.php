<?php declare(strict_types=1);

namespace App\Formatters\Api;

use App\Models\AttributeCategory;
use Nkf\General\Classes\BaseFormatter;

class CategoryApiFormatter extends BaseFormatter
{
    public function __construct()
    {
        $this->setFormatter(function (AttributeCategory $category) : array
        {
            return [
                'id' => $category->id,
                'name' => $category->name,
            ];
        });
    }
}
