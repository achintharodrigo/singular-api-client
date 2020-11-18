<?php


namespace AchinthaRodrigo\SingularApiClient;

class Singular
{
    private $baseUrl = '';
    private $apiKey = '';

    public function __construct()
    {
        $this->baseUrl = config('singular.SINGULAR_BASE_URL');
        $this->apiKey = config('singular.SINGULAR_API_KEY');
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }
}
