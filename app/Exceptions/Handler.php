<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            $data = [
                'status' => 'error',
                'message' =>'Validation error',
                'errors' => $exception->validator->getMessageBag(),
            ];
            return api_error($data, 400);
        }

        if ($exception instanceof AuthorizationException) {
            $data = [
                'status' => 'error',
                'message' =>'Authorization error',
            ];
            return api_error($data, 403);
        }

        if ($exception instanceof AuthenticationException) {
            $data = [
                'status' => 'error',
                'message' =>'Authentication error. Wrong api_token',
            ];
            return api_error($data, 403);
        }

        if ($exception instanceof ModelNotFoundException) {
            $data = [
                'status' => 'error',
                'message' =>'Object not found',
            ];
            return api_error($data, 403);
        }

        return parent::render($request, $exception);
    }
}
