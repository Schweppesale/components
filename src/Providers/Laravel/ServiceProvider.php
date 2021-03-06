<?php
namespace Schweppesale\Module\Core\Providers\Laravel;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Schweppesale\Module\Core\Exceptions\ModuleExceptionHandler;

/**
 * Class ServiceProvider
 * @package Schweppesale\Module\Core\Providers\Laravel
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * @return ModuleExceptionHandler
     */
    public function getExceptionHandler(): ModuleExceptionHandler
    {
        return $this->app->make(ExceptionHandler::class);
    }

    /**
     * Merge the given configuration recursively with the existing configuration.
     *
     * @param  string $path
     * @param  string $key
     * @return void
     */
    protected function mergeConfigRecursiveFrom($path, $key)
    {
        $config = $this->app['config']->get($key, []);

        $this->app['config']->set($key, array_merge_recursive(require $path, $config));
    }
}
