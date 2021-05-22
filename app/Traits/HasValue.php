<?php declare(strict_types=1);

namespace App\Traits;

use App\Enums\AttributeTypeEnum;

/**
 * Таблица модели должна иметь поля:
 * value_int
 * value_string
 * value_bool
 * value_double
 */
trait HasValue
{
    public abstract function getType() : int;

    public function getFiledValue() : string { return sprintf('value_%s', AttributeTypeEnum::getValues()[$this->getType()]); }

    public function getValueAttribute() { return $this->getAttribute($this->getFiledValue()); }
    public function setValueAttribute($value) : void { $this->setAttribute($this->getFiledValue(), $value); }

    public function castValue($value)
    {
        $result = null;
        switch($this->getType()) {
            case AttributeTypeEnum::INT: $result = (int)$value; break;
            case AttributeTypeEnum::STRING: $result = (string)$value; break;
            case AttributeTypeEnum::BOOL: $result = (bool)$value; break;
            case AttributeTypeEnum::DOUBLE: $result = (double)$value; break;
        }

        return $result;
    }
}
