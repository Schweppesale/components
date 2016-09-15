<?php
namespace Schweppesale\Module\Core\Collections;

/**
 * Interface HighOrderInterface
 * @package Schweppesale\Module\Core\Collections
 */
interface HighOrderInterface
{

    /**
     * @param callable $function
     * @return Collection
     */
    public function map(callable $function);

    /**
     * @param callable $function
     * @return mixed
     */
    public function reduce(callable $function);

    /**
     * @param callable $function
     * @return static
     */
    public function filter(callable $function);
}