<?php

namespace App\Exceptions;

use App\Traits\apiResponseBuilder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use apiResponseBuilder;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * @param Request $request
     * @param Throwable $exception
     * @return JsonResponse|Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render( $request, $exception )
    {
        if ( $exception instanceof ModelNotFoundException && $request -> wantsJson()) {
            return $this -> errorResponse( null, 'Error', 'Resource not found', Response::HTTP_NOT_FOUND );
        }
        elseif ( $exception instanceof MethodNotAllowedHttpException )
        {
            return $this -> errorResponse( null, 'Error', 'You do not have permission to perform this action', Response::HTTP_METHOD_NOT_ALLOWED );
        }
        elseif ( $exception instanceof NotFoundHttpException )
        {
            return $this -> errorResponse( null, 'Error', 'Endpoint do not exist', Response::HTTP_NOT_FOUND );
        }

        return parent::render( $request, $exception );
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
