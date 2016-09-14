<?php
namespace Schweppesale\Module\Core\Mapper;

/**
 * Interface MapperInterface
 * @package Schweppesale\Module\Core\Mapper
 */
interface MapperInterface
{
    /**
     * @param $source
     * @param $destination
     * @return mixed
     */
    public function map($source, $destination);
}
