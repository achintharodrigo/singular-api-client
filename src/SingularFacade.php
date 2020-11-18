<?php

namespace AchinthaRodrigo\SingularApiClient;

use Illuminate\Support\Facades\Facade;

/**
 * Class SingularFacade
 * @package AchinthaRodrigo\SingularApiClient
 * @see \AchinthaRodrigo\SingularApiClient\Singular
 */
class SingularFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AchinthaRodrigo\SingularApiClient\Singular';
    }
}
