<?php

namespace Turksoy\ResponseBuilder\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Turksoy\ResponseBuilder\Skeleton\SkeletonClass
 */
class ResponseBuilder extends Facade
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
