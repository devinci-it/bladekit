<?php

namespace Devinci\Bladekit\Helpers;

class StringHelper
{
    public static function studlyCase($value)
    {
        return str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $value)));
    }
}
