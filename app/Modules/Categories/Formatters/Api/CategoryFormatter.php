<?php declare(strict_types=1);

namespace App\Modules\Categories\Formatters\Api;

use App\Modules\Categories\Models\Category;
use Nkf\General\Classes\BaseFormatter;

class CategoryFormatter extends BaseFormatter
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
