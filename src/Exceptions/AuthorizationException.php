<?php


namespace AchinthaRodrigo\SingularApiClient\Exceptions;

class AuthorizationException extends \Exception
{

    /**
     * AuthorizationException constructor.
     */
    public function __construct()
    {
        parent::__construct('Unable to authenticate Singular');
    }
}
