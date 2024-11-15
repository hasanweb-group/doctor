<?php

namespace App\Enums;


enum Gender: string
{
    case male = 'male';
    case female = "female";


    public static function getLabelByValue(string $value): string
    {
        return __(Localization::Patient->value . '.gender.' . $value);
    }


    public function label(): string
    {
        return __(Localization::Patient->value . '.gender.' . $this->value);
    }
}
