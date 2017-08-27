<?php

/**
 * Copyright (c) 2017 Martin Pettersson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Solid\Support\Tests;

use phpmock\phpunit\PHPMock;
use Solid\Support\Env;
use PHPUnit\Framework\TestCase;

/**
 * @package Solid\Support\Tests
 * @author Martin Pettersson <martin@solid-framework.com>
 * @coversDefaultClass Solid\Support\Env
 */
class EnvTest extends TestCase
{
    use PHPMock;

    /**
     * @test
     * @covers ::isCli
     */
    public function isCliShouldReturnTrueIfSapiBeginsWithCli(): void
    {
        $phpSapiName = $this->getFunctionMock('Solid\Support', 'php_sapi_name');
        $phpSapiName->expects($this->once())
                    ->willReturn('cli-server');

        $this->assertTrue(Env::isCli());
    }

    /**
     * @test
     * @covers ::isCli
     */
    public function isCliShouldReturnFalseIfSapiDoesNotBeginWithCli(): void
    {
        $phpSapiName = $this->getFunctionMock('Solid\Support', 'php_sapi_name');
        $phpSapiName->expects($this->once())
                    ->willReturn('fpm-cli');

        $this->assertFalse(Env::isCli());
    }
}
