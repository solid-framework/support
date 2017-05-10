<?php

/**
 * Copyright (c) 2017 Martin Pettersson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Framework\Support\Tests;

use Framework\Support\Arr;
use PHPUnit\Framework\TestCase;

/**
 * @package Framework\Support\Tests
 * @author Martin Pettersson <martin@framework.com>
 * @since 0.1.0
 * @coversDefaultClass Framework\Support\Arr
 */
class ArrTest extends TestCase
{
    /**
     * @since 0.1.0
     * @var array
     */
    protected $exampleArray1;

    /**
     * @since 0.1.0
     * @var array
     */
    protected $exampleArray2;

    /**
     * @since 0.1.0
     * @var array
     */
    protected $mergedArrays1And2;

    /**
     * @since 0.1.0
     * @var array
     */
    protected $mergedArrays1And2Indexed;

    /**
     * @since 0.1.0
     * @before
     */
    public function setup(): void
    {
        $this->exampleArray1 = [
            1,
            2,
            'three' => [
                'key1' => 'value1',
                'key2' => 'value2',
                'list' => [1, 2, 3, 4]
            ]
        ];

        $this->exampleArray2 = [
            4,
            5,
            'three' => [
                'key1' => 'new value1',
                'newkey' => 'value',
                'list' => [4, 5]
            ]
        ];

        $this->mergedArrays1And2 = [
            4,
            5,
            'three' => [
                'key1' => 'new value1',
                'key2' => 'value2',
                'newkey' => 'value',
                'list' => [4, 5]
            ]
        ];

        $this->mergedArrays1And2Indexed = [
            4,
            5,
            'three' => [
                'key1' => 'new value1',
                'key2' => 'value2',
                'newkey' => 'value',
                'list' => [1, 2, 3, 4, 5]
            ]
        ];
    }

    /**
     * @since 0.1.0
     * @test
     * @covers ::isAssociative
     */
    public function shouldReturnTrueIfTheGivenArrayIsAssociative(): void
    {
        $this->assertTrue(Arr::isAssociative(['key' => 'value']));
        $this->assertTrue(Arr::isAssociative(['one', 'two', 'key' => 'value']));
        $this->assertTrue(Arr::isAssociative([1, 2, 'three' => 'value']));
    }

    /**
     * @since 0.1.0
     * @test
     * @covers ::isAssociative
     */
    public function shouldReturnFalseIfTheGivenArrayIsNotAssociative(): void
    {
        $this->assertFalse(Arr::isAssociative([]));
        $this->assertFalse(Arr::isAssociative([1, 2, 3]));
        $this->assertFalse(Arr::isAssociative([1, 2, '3' => 'value']));
    }

    /**
     * @since 0.1.0
     * @test
     * @covers ::merge
     */
    public function shouldMergeTheGivenArrays(): void
    {
        $mergedArrays = Arr::merge($this->exampleArray1, $this->exampleArray2);

        $this->assertEquals($this->mergedArrays1And2, $mergedArrays);
    }

    /**
     * @since 0.1.0
     * @test
     * @covers ::merge
     */
    public function shouldMergeTheGivenArraysIndexedArrays(): void
    {
        $mergedArrays = Arr::merge($this->exampleArray1, $this->exampleArray2, true);

        $this->assertEquals($this->mergedArrays1And2Indexed, $mergedArrays);
    }
}
