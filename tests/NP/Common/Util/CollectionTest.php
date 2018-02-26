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

class CollectionTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Common\Util\Collection
     */
    private $instance;

    /**
     * @var array
     */
    private $array;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $value;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->key = 'key';
        $this->value = 'value';
        $this->array = [$this->key => $this->value];
        $this->instance = new Collection();
    }


    /**
     * @covers \NP\Common\Util\Collection::fill
     * @covers \NP\Common\Util\Collection::getItem
     */
    public function testFill()
    {
        $this->instance->fill($this->array);

        $this->assertEquals($this->value, $this->instance->getItem($this->key));
    }


    /**
     * @covers \NP\Common\Util\Collection::addItem
     * @covers \NP\Common\Util\Collection::getItem
     */
    public function testAddItem()
    {
        $key2 = 'key2';
        $value2 = 'value2';
        $this->instance->addItem($value2, $key2);
        $this->assertEquals($value2, $this->instance->getItem($key2));

        $value3 = 'value2';
        $this->instance->addItem($value3);
        $this->assertEquals($value3, $this->instance->getItem());
    }


    /**
     * @covers \NP\Common\Util\Collection::getIterator
     */
    public function testGetIterator()
    {
        $key2 = 'key2';
        $value2 = 'value2';
        $this->instance->addItem($value2, $key2);

        foreach ($this->instance as $k => $item) {
            $this->assertEquals($key2, $k);
            $this->assertEquals($value2, $item);
        }
    }
}
