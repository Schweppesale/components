<?php
namespace Schweppesale\Module\Core\Mapper;
use Schweppesale\Module\Core\Collections\Collection;

/**
 * Interface MapperInterface
 * @package Schweppesale\Module\Core\Mapper
 */
interface MapperInterface
{
    /**
     * @param $source
     * @param $destination
     * @return object|\object[]
     */
    public function map($source, $destination);

    /**
     * @param array $source
     * @param $sourceType
     * @param $destination
     * @return object|\object[]
     */
    public function mapArray(array $source, $sourceType, $destination);

    /**
     * @param Collection $source
     * @param $sourceType
     * @param $destination
     * @return object|\object[]
     */
    public function mapCollection(Collection $source, $sourceType, $destination);
}
