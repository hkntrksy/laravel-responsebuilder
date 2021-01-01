<?php

namespace Turksoy\ResponseBuilder\Tests;

use Orchestra\Testbench\TestCase;
use Turksoy\ResponseBuilder\ResponseBuilderServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [ResponseBuilderServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
