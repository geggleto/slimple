<?php
declare(strict_types=1);


namespace App\Infrastructure\Identity;


use InvalidArgumentException;
use JsonSerializable;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid implements JsonSerializable
{
    private string $value;

    /**
     * @throws InvalidArgumentException|\Exception
     */
    public function __construct(?string $value = null)
    {
        if ($value) {
            if (!RamseyUuid::isValid($value)) {
                throw new InvalidArgumentException("{$value} is not a valid UUID");
            }
            $this->value = $value;
        } else {
            $this->value = (string) RamseyUuid::uuid4();
        }
    }

    public static function isValid(string $value): bool
    {
        return RamseyUuid::isValid($value);
    }

    public function getUuid(): string
    {
        return $this->value;
    }

    public function equals(Uuid $uuid): bool
    {
        return (string) $uuid === $this->value;
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}