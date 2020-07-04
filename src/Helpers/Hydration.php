<?php

namespace ANovikov\Helpers;

use ReflectionClass;
use ReflectionException;

/**
 * Class Hydrator
 * @package ANovikov\Helpers
 * @see https://3v4l.org/R41pr
 */
class Hydration
{
    /**
     * @param array $array
     * @param $object
     * @return mixed
     */
    public function toObject(array $array, $object)
    {
        foreach ($array as $key => $value) {
            $setterName = self::camel('set_' . $key);
            if (method_exists($object, $setterName)) {
                $object->{$setterName}($value);
            }
        }

        return $object;
    }

    /**
     * @param $object
     */
    public function toArray($object)
    {

    }

    /**
     * Convert a value to lower camel case.
     *
     * @param  string $value
     * @return string
     */
    public static function camel($value): string
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));
        return lcfirst(str_replace(' ', '', $value));
    }
}
