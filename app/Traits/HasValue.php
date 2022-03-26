<?php declare(strict_types=1);

namespace App\Traits;

use App\Enums\ValueTypeEnum;

trait HasValue
{
    protected string $valuePrefix = 'value_';

    public abstract function getType() : int;

    public function getFiledValue() : string
    {
        return sprintf('%s%s', $this->valuePrefix, ValueTypeEnum::getValues()[$this->getType()]);
    }

    /** @return int|string|bool|double */
    public function getValueAttribute()
    {
        return $this->getAttribute($this->getFiledValue());
    }

    public function setValueAttribute($value) : void
    {
        $this->setAttribute($this->getFiledValue(), $value);
    }

    /** @return int|string|bool|double|null */
    public function castValue($value)
    {
        $result = null;
        switch($this->getType()) {
            case ValueTypeEnum::INT: $result = (int)$value; break;
            case ValueTypeEnum::STRING: $result = (string)$value; break;
            case ValueTypeEnum::BOOL: $result = (bool)$value; break;
            case ValueTypeEnum::DOUBLE: $result = (double)$value; break;
        }

        return $result;
    }
}
