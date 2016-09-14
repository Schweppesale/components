<?php
namespace Schweppesale\Module\Core\Mapper\Papper;

use Papper\Papper;
use Schweppesale\Module\Core\Mapper\MapperInterface;

class Mapper implements MapperInterface
{

    /**
     * @param mixed $source
     * @param mixed $destination
     */
    public function map($source, $destination)
    {
        return Papper::map($source)->toType($destination);
    }
}
