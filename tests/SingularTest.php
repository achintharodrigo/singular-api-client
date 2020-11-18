<?php

namespace AchinthaRodrigo\SingularApiClient\Tests;

use AchinthaRodrigo\SingularApiClient\Singular;
use PHPUnit\Framework\TestCase;

class SingularTest extends TestCase
{
    /**
     * @test
     */
    public function checkBaseUrl()
    {
        $this->assertEquals('https://api.singular.net/api/', (new Singular())->getBaseUrl());
    }
}
