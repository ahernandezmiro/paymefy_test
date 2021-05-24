<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;
use App\Services\HTTPFetchUsersService;
use App\Services\XMLFetchUsersService;

class FetchUsersServiceFactory
{
    public static function getAllFetchUsersServices() : array {
        $allFetchUsersServices = array();

        $allFetchUsersServices[] = self::newHttpFetchUsersService();
        $allFetchUsersServices[] = self::newXMLFetchUsersService();

        return $allFetchUsersServices;
    }

    private static function newHttpFetchUsersService() : HttpFetchUsersService {
        $httpClient = HttpClient::create();
        return new HTTPFetchUsersService($httpClient);
    }

    private static function newXMLFetchUsersService() : XMLFetchUsersService {
        return new XMLFetchUsersService();
    }
}