<?php

namespace App\Repository;

use App\Model\User;

class CSVUserRepository implements UserRepository
{
    const OUTPUT_PATH = __DIR__ . '/../../out/csv/';

    public function store(array $users){

        $outputFilePath = self::OUTPUT_PATH . date('Ymd-His') . '.csv';

        $fp = fopen($outputFilePath, 'w');

        if(!$fp)
            throw new \Exception("Error creating csv file");

        $this->addHeaders($fp);

        foreach ($users as $user) {
            $line = array(
                $user->getName(),
                $user->getEmail(),
                $user->getPhone(),
                $user->getCompany()
            );

            fputcsv($fp, $line);
        }

        fclose($fp);
    }

    private function addHeaders($fp){
        $line = array(
            "Nombre",
            "Email",
            "Teléfono",
            "Empresa"
        );

        fputcsv($fp, $line);
    }
}