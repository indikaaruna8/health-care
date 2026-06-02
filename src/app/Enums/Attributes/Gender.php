<?php

namespace App\Enums\Attributes;

enum Gender: int
{
    case MALE = 1;
    case FEMALE = 2;
    case OTHER = 3;
    case PREFER_NOT_TO_SAY = 4;

    public function label(): string
    {
        return match ($this) {
            self::MALE => 'Male',
            self::FEMALE => 'Female',
            self::OTHER => 'Other',
            self::PREFER_NOT_TO_SAY => 'Prefer not to say',
        };
    }

    public function code(): ?string
    {
        return match ($this) {
            self::MALE => 'M',
            self::FEMALE => 'F',
            self::OTHER => 'O',
            self::PREFER_NOT_TO_SAY => null,
        };
    }

    public static function all(): array
    {
        return array_map(
            fn (self $gender) => [
                'id' => $gender->value,
                'name' => $gender->label(),
                'code' => $gender->code(),
                'active' => true,
            ],
            self::cases()
        );
    }

    public static function toArray(): array
    {
        return array_map(
            fn (self $gender) => [
                'id' => $gender->value,
                'name' => $gender->label(),
                'code' => $gender->code(),
            ],
            self::cases()
        );
    }
}
