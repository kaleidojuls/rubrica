<?php

namespace User\DatabaseAbstraction;

class Helper
{

    public static function AccessToValue(?array $values, string $key, string $defaultValue = null): mixed
    {

        if (is_null($values))
            return $defaultValue;

        return array_key_exists($key, $values) ? $values[$key] : $defaultValue;

    }
}