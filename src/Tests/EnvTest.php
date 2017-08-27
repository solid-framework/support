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

    protected $server;

    /**
     * @param null   $name
     * @param array  $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->server = $_SERVER;
    }

    /**
     * @before
     */
    public function setUp()
    {
        parent::setUp();

        global $_SERVER;

        $_SERVER = $this->server;
    }

    /**
     * @test
     * @covers ::isCli
     */
    public function shouldDetermineIfCli(): void
    {
        global $_SERVER;

        unset($_SERVER['SERVER_NAME']);
        $phpSapiName = $this->getFunctionMock('Solid\Support', 'php_sapi_name');
        $phpSapiName->expects($this->exactly(3))
                    ->willReturnOnConsecutiveCalls('cli-server', 'cli-server', 'fpm-cli');

        // True if SAPI begins with "cli" and no server name is present.
        $this->assertTrue(Env::isCli());

        $_SERVER['SERVER_NAME'] = 'server-name';

        // False if server name is present.
        $this->assertFalse(Env::isCli());

        unset($_SERVER['SERVER_NAME']);
        $phpSapiName->expects($this->atLeastOnce())
                    ->willReturn('fpm-cli');

        // False if SAPI does NOT begin with "cli".
        $this->assertFalse(Env::isCli());
    }
}
