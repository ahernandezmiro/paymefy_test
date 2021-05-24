<?php

namespace App\Services;

use App\Model\User;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HTTPFetchUsersService implements FetchUsersService
{

    public function __construct(
        private HttpClientInterface $client
        ){}

    public function fetch() : array {
        try{
            $fetched = array();

            $response = $this->client->request(
                'GET',
                'https://jsonplaceholder.typicode.com/users'
            );
    
            $statusCode = $response->getStatusCode();
    
            if($statusCode != 200)
                throw new \Exception("Error fetching users");
    
            foreach($response->toArray() as $user){
                try{
                    $user = new User(
                        $user['email'],
                        $user['name'],
                        $user['phone'],
                        $user['company']['name']
                    );
    
                    $fetched[] = $user;
                } catch(\Exception $e){
                    //error parsing user
                }
            }
           
            return $fetched;
        } catch(\Exception $e){
            throw $e;
        }
    }
}