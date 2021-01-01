<?php

namespace Turksoy\ResponseBuilder\Traits;

use Illuminate\Validation\ValidationException;

use Turksoy\ResponseBuilder\Facades\ResponseBuilder;

trait ResponseBuilderExceptionHandler
{

    public function invalidJson($request, ValidationException $exception)
    {
        return ResponseBuilder::message('validation_error', $exception->errors())
            ->validationFail();
    }

}
