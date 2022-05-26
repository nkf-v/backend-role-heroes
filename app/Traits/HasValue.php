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

    public function getValueAttribute(): int|string|bool|float
    {
        return $this->getAttribute($this->getFiledValue());
    }

    public function setValueAttribute($value) : void
    {
        $this->setAttribute($this->getFiledValue(), $value);
    }

    public function castValue($value): float|bool|int|string|null
    {
        return match ($this->getType()) {
            ValueTypeEnum::INT, ValueTypeEnum::SELECT => (int)$value,
            ValueTypeEnum::STRING => (string)$value,
            ValueTypeEnum::BOOL => (bool)$value,
            ValueTypeEnum::DOUBLE => (double)$value,
            default => null,
        };
    }
}
