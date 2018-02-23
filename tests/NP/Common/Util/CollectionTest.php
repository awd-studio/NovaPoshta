<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test\Common\Util;

use NP\Common\Util\Collection;
use PHPUnit\Framework\TestCase;

/**
 * Class CollectionTest
 * @package NP\Test\Common\Util
 */
class CollectionTest extends TestCase
{

    /**
     * Instance.
     *
     * @var Collection
     */
    private $instance;

    /**
     * @var array
     */
    private $array;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new Collection();
        $this->array = ['test' => 'value'];
    }


    /**
     * @covers \NP\Common\Util\Collection::fill
     * @covers \NP\Common\Util\Collection::getItem
     */
    public function testFill()
    {
        $this->instance->fill($this->array);

        $this->assertEquals('value', $this->instance->getItem('test'));
    }


    /**
     * @covers \NP\Common\Util\Collection::addItem
     * @covers \NP\Common\Util\Collection::getItem
     */
    public function testAdd()
    {
        $this->instance->addItem($this->array, 'name');
        $this->assertEquals($this->array, $this->instance->getItem());

        $newArray = ['new' => 'array'];

        $this->instance->addItem($newArray);
        $this->assertEquals($newArray, $this->instance->getItem());
    }


    /**
     * @covers \NP\Common\Util\Collection::getIterator
     */
    public function testGetIterator()
    {
        $this->instance->fill($this->array);

        foreach ($this->instance as $name => $item) {
            $this->assertEquals(key($this->array), $name);
            $this->assertEquals(end($this->array), $item);
        }
    }
}
