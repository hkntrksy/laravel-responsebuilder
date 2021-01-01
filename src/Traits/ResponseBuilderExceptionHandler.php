<?php

namespace Turksoy\ResponseBuilder\Traits;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;

use Turksoy\ResponseBuilder\Facades\ResponseBuilder;

trait ResponseBuilderExceptionHandler
{

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Validation\ValidationException  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function invalidJson($request, ValidationException $exception)
    {
        return ResponseBuilder::message('validation_error', $exception->errors())
            ->validationFail();
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? ResponseBuilder::message('error', 'auth.unauthenticated')->unauthorized()
            : redirect()->guest($exception->redirectTo() ?? route('login'));
    }

}
