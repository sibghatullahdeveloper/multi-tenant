<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

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

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            $json = [
                'success'=>false,
                'responsecode' => 401,
                'message' => $exception->getMessage(),
                'data' => (object) []
            ];
            return response()
                ->json($json, 401);
        }
    }



    protected function invalidJson($request, ValidationException $exception)
    {
        // $test = implode(", ",);
        $error = array();
        $error_array = array_values($exception->errors());
        foreach ($error_array as $value) {
            # code...
            $error[] = implode(", ",$value);
        }
        return response()->json([
            'success' => false,
            'responsecode' => 401,
            'message' => implode(',',$error),
            'data' => (object) array(),
        ], 200);
    }


}
