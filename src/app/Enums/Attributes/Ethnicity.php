<?php

namespace App\Enums\Attributes;

enum Ethnicity: int
{
    case WHITE = 1;
    case BLACK_OR_AFRICAN_AMERICAN = 2;
    case ASIAN = 3;
    case HISPANIC_OR_LATINO = 4;
    case NATIVE_AMERICAN_OR_ALASKAN_NATIVE = 5;
    case NATIVE_HAWAIIAN_OR_PACIFIC_ISLANDER = 6;
    case MIDDLE_EASTERN_OR_NORTH_AFRICAN = 7;
    case MULTIRACIAL = 8;
    case OTHER = 9;
    case PREFER_NOT_TO_SAY = 10;

    public function label(): string
    {
        return match ($this) {
            self::WHITE => 'White',
            self::BLACK_OR_AFRICAN_AMERICAN => 'Black or African American',
            self::ASIAN => 'Asian',
            self::HISPANIC_OR_LATINO => 'Hispanic or Latino',
            self::NATIVE_AMERICAN_OR_ALASKAN_NATIVE => 'Native American or Alaskan Native',
            self::NATIVE_HAWAIIAN_OR_PACIFIC_ISLANDER => 'Native Hawaiian or Pacific Islander',
            self::MIDDLE_EASTERN_OR_NORTH_AFRICAN => 'Middle Eastern or North African',
            self::MULTIRACIAL => 'Multiracial',
            self::OTHER => 'Other',
            self::PREFER_NOT_TO_SAY => 'Prefer not to say',
        };
    }

    public function code(): ?string
    {
        return match ($this) {
            self::WHITE => 'W',
            self::BLACK_OR_AFRICAN_AMERICAN => 'B',
            self::ASIAN => 'A',
            self::HISPANIC_OR_LATINO => 'H',
            self::NATIVE_AMERICAN_OR_ALASKAN_NATIVE => 'N',
            self::NATIVE_HAWAIIAN_OR_PACIFIC_ISLANDER => 'P',
            self::MIDDLE_EASTERN_OR_NORTH_AFRICAN => 'M',
            self::MULTIRACIAL => 'MR',
            self::OTHER => 'O',
            self::PREFER_NOT_TO_SAY => null,
        };
    }

    public static function all(): array
    {
        return array_map(
            fn (self $ethnicity) => [
                'id' => $ethnicity->value,
                'name' => $ethnicity->label(),
                'code' => $ethnicity->code(),
                'active' => true,
            ],
            self::cases()
        );
    }

    public static function toArray(): array
    {
        return array_map(
            fn (self $ethnicity) => [
                'id' => $ethnicity->value,
                'name' => $ethnicity->label(),
                'code' => $ethnicity->code(),
            ],
            self::cases()
        );
    }
}
