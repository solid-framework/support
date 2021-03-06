<?php

/**
 * Copyright (c) 2017 Martin Pettersson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Solid\Support;

/**
 * @package Solid\Support
 * @author Martin Pettersson <martin@solid-framework.com>
 */
class Env
{
    /**
     * @return bool
     */
    public static function isCli(): bool
    {
        return strpos(php_sapi_name(), 'cli') === 0 && !isset($_SERVER['SERVER_NAME']);
    }
}
