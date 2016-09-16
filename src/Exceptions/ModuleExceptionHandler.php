<?php
namespace Schweppesale\Module\Core\Exceptions;

interface ModuleExceptionHandler {

    /**
     * @param string $exception
     * @param callable $handler
     * @return void
     */
    public function addModuleExceptionHandler(string $exception, callable $handler);
}