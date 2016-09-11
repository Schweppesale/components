<?php
namespace Schweppesale\Components\Collections;

/**
 * Class Collection
 * @package Schweppesale\Components\Collections
 */
class Collection implements \Iterator, HighOrderInterface  {

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

    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->container[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->container[$this->position]);
    }
}