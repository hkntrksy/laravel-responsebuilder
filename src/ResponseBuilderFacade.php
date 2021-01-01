<?php

namespace Turksoy\ResponseBuilder;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Turksoy\ResponseBuilder\Skeleton\SkeletonClass
 */
class ResponseBuilderFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'responsebuilder';
    }
}
