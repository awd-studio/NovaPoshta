<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

declare(strict_types=1); // strict mode


namespace NP\Common\Util;

use IteratorAggregate;


/**
 * Class Collection
 * @package NP\Common\Util
 */
class Collection implements IteratorAggregate
{

    /**
     * @var array Collection.
     */
    protected $collection = [];


    /**
     * Fill collection with items.
     *
     * @param array $array
     */
    public function fill(array $array = [])
    {
        $this->collection = $array;
    }


    /**
     * Add item to collection.
     *
     * @param mixed                 $item
     * @param string|float|int|null $name
     *
     * @return mixed Added key.
     */
    public function addItem($item, $name = null)
    {
        if ($name) {
            $this->collection[$name] = $item;
        } else {
            $this->collection[] = $item;
            end($this->collection);
            $name = key($this->collection);
            reset($this->collection);
        }

        return $name;
    }


    /**
     * Get item by ID.
     *
     * @param mixed $id
     *
     * @return mixed Item from collection by ID. If ID is NULL - return last added item.
     */
    public function getItem($id = null)
    {
        if ($id) {
            return $this->collection[$id] ?? null;
        } else {
            $collection = $this->collection;
            return array_pop($collection);
        }
    }


    /**
     * Get iterator.
     *
     * @return \ArrayIterator|\Generator
     */
    public function getIterator()
    {
        foreach ($this->collection as $key => $value) {
            yield $key => $value;
        }
    }
}
