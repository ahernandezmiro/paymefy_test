<?php

namespace App\Repository;

use App\Model\User;

class DBUserRepository implements UserRepository
{
    private $connection;

    public function __construct(
        private string $host,
        private string $db,
        private string $user,
        private string $pass
    ){
        try {
            $this->connection = new \PDO("mysql:host=$host;dbname=$db", $user, $pass);
            // set the PDO error mode to exception
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
          } catch(\PDOException $e) {
            throw new \Exception("Could not connect to database: " . $e->getMessage());
          }
    }

    public function store(array $users){
        $sql = "INSERT INTO users (email, name, phone, company) VALUES ";
        $first = true;
        foreach($users as $user){
            if(!$first)
                $sql .= ", ";
            
            $sql .= "('" . $user->getEmail() . "','" . str_replace("'", "''", $user->getName()) . "','" . $user->getPhone() . "','" . str_replace("'", "''", $user->getCompany()) . "')";
            $first = false;
        }

        if (!$this->connection->query($sql)) {
            throw new \Exception("Error inserting users to database: " . $conn->error);
        }
    }
}