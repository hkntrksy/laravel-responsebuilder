<?php

namespace Turksoy\ResponseBuilder\Traits;

use Throwable;
use Illuminate\Support\Arr;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    /**
     * Prepare a JSON response for the given exception.
     *
     * @param \Illuminate\Http\Request $request
     * @param Throwable $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function prepareJsonResponse($request, Throwable $exception)
    {

        if ($exception instanceof NotFoundHttpException) {
            return ResponseBuilder::message('error','messages.not_found')
                ->notFound();
        }

        $errorDetail = [
            'exception' => get_class($exception),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => collect($exception->getTrace())->map(function ($trace) {
                return Arr::except($trace, ['args']);
            })->all()
        ];

        return config('app.debug') ? ResponseBuilder::message('error',$exception->getMessage())
            ->custom('error_detail', $errorDetail)
            ->internalServerError() : ResponseBuilder::message('error', 'messages.ops')
            ->badRequest();

    }

}
