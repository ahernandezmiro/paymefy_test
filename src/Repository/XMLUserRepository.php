<?php

namespace App\Repository;

use App\Model\User;

class XMLUserRepository implements UserRepository
{
    const OUTPUT_PATH = __DIR__ . '/../../out/xml/';

    public function store(array $users){

        $xml = new \SimpleXMLElement('<clientes/>');

        foreach($users as $user){
            $userTree = $xml->addChild('cliente');

            $userTree->addChild('nombre', $user->getName());
            $userTree->addChild('email', $user->getEmail());
            $userTree->addChild('telefono', $user->getPhone());
            $userTree->addChild('empresa', $user->getCompany());
        }
        
        $outputFilePath = self::OUTPUT_PATH . date('Ymd-His') . '.xml';

        if(!$xml->asXML($outputFilePath))
            throw new \Exception("Error creating xml file");
    }
}