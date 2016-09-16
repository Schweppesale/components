<?php
namespace Schweppesale\Module\Core\Collections;

use ArrayAccess;
use Iterator;
use JsonSerializable;

/**
 * Class Collection
 * @package Schweppesale\Module\Core\Collections
 */
class Collection implements Iterator, HighOrderInterface, ArrayAccess, JsonSerializable
{

    /**
     * @var int
     */
    private $position = 0;

    /**
     * @var array
     */
    private $container = [];

    /**
     * Collection constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->container = $data;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->container);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->container[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * @param callable $function
     * @return Collection
     */
    public function map(callable $function)
    {
        return new self(array_map($function, $this->container));
    }

    /**
     * @param callable $function
     * @return mixed
     */
    public function reduce(callable $function)
    {
        return array_reduce($this->container, $function);
    }

    /**
     * @param callable $function
     * @return static
     */
    public function filter(callable $function)
    {
        return new static(array_filter($this->container, $function));
    }

    /**
     * @return void
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->container[$this->position];
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @return void
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return isset($this->container[$this->position]);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->container;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->container;
    }
}