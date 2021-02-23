<?php declare(strict_types=1);

namespace App\Formatters\Api;

use App\Models\Category;
use Nkf\General\Classes\BaseFormatter;

class CategoryApiFormatter extends BaseFormatter
{
    public function __construct()
    {
        $this->setFormatter(function (Category $category) : array
        {
            return [
                'id' => $category->id,
                'name' => $category->name,
            ];
        });
    }
}
