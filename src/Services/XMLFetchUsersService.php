<?php

namespace App\Services;

use App\Model\User;

class XMLFetchUsersService implements FetchUsersService
{
    const XML_PATH = __DIR__ . '/../../data/xml/data.xml';

    public function fetch() : array {
        try{
            $fetched = array();

            $content = simplexml_load_file(self::XML_PATH);
    
            foreach($content as $user){
                try{
                    $user = new User(
                        $user,
                        $user->attributes()['name'],
                        $user->attributes()['phone'],
                        $user->attributes()['company']
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