<?php

namespace Schweppesale\Module\Core\Exceptions\Laravel;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Schweppesale\Module\Core\Exceptions\ModuleExceptionHandler;

class Handler extends ExceptionHandler implements ModuleExceptionHandler
{

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];
    /**
     * @var array
     */
    private $moduleExceptionHandler = [];

    /**
     * @param string $exception
     * @param callable $handler
     * @return void
     */
    public function addModuleExceptionHandler(string $exception, callable $handler)
    {
        if (array_key_exists($exception, $this->moduleExceptionHandler) === true) {
            throw new \RuntimeException("Handler has already been set for " . $exception);
        }
        $this->moduleExceptionHandler[$exception] = $handler;
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $className = get_class($exception);
        if (array_key_exists($className, $this->moduleExceptionHandler)) {
            return call_user_func_array($this->moduleExceptionHandler[$className], [$request, $exception, app(Response::class)]);
        }

        if ($request->wantsJson()) {
            return response()->json(['error' => $exception->getMessage()], 401);
        }

        return parent::render($request, $exception);
    }

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {

        if ($request->acceptsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        throw new \Schweppesale\Module\Core\Exceptions\Exception($exception->getMessage(), 0, $exception);
    }
}
