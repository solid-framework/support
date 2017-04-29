<?php

/**
 * Copyright (c) 2017 Martin Pettersson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Framework\Support;

/**
 * @package Framework\Support
 * @author Martin Pettersson <martin@framework.com>
 * @since 0.1.0
 */
class Arr
{
    /**
     * @api
     * @since 0.1.0
     * @param mixed $item
     * @return bool
     */
    public static function isAssociative($item): bool
    {
        return is_array($item) && count(array_filter(array_keys($item), 'is_string')) > 0;
    }

    /**
     * @api
     * @since 0.1.0
     * @param array $a
     * @param array $b
     * @param bool  $mergeIndexed
     * @return array
     */
    public static function merge(array $a, array $b, bool $mergeIndexed = false): array
    {
        foreach ($b as $key => $value) {
            if (array_key_exists($key, $a)) {
                if (static::isAssociative($a[$key]) && static::isAssociative($value)) {
                    $a[$key] = static::merge($a[$key], $value, $mergeIndexed);
                } elseif ($mergeIndexed && is_array($a[$key]) && is_array($value)) {
                    $a[$key] = array_values(array_unique(array_merge($a[$key], $value)));
                } else {
                    $a[$key] = $value;
                }
            } else {
                $a[$key] = $value;
            }
        }

        return $a;
    }
}
