<?php

use Turksoy\ResponseBuilder\ResponseBuilder;

if(!function_exists('responseBuilder')){
    function responseBuilder(): ResponseBuilder
    {
        return new ResponseBuilder;
    }
}
