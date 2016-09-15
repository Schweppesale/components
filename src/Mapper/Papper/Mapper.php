<?php
namespace Schweppesale\Module\Core\Mapper\Papper;

use Papper\Papper;
use Schweppesale\Module\Core\Collections\Collection;
use Schweppesale\Module\Core\Mapper\MapperInterface;

/**
 * Class Mapper
 * @package Schweppesale\Module\Core\Mapper\Papper
 */
class Mapper implements MapperInterface
{

    /**
     * @param $source
     * @param $destination
     * @return object|\object[]
     */
    public function map($source, $destination)
    {
        return Papper::map($source)->toType($destination);
    }

    /**
     * @param array $source
     * @param $sourceType
     * @param $destination
     * @return object|\object[]
     */
    public function mapArray(array $source, $sourceType, $destination)
    {
        return Papper::map($source, $sourceType)->toType($destination);
    }

    /**
     * @param Collection $source
     * @param $sourceType
     * @param $destination
     * @return object|\object[]
     */
    public function mapCollection(Collection $source, $sourceType, $destination)
    {
        return Papper::map($source->toArray(), $sourceType)->toType($destination);
    }
}
