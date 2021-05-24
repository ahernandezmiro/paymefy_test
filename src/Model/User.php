<?php

namespace App\Model;

class User
{
    public function __construct(
        private string $email,
        private string $name,
        private string $phone,
        private string $company
        ) {
       
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new \Exception("Invalid email address");

        //if(!preg_match("/^(?:[0-9]{1}-){0,1}[0-9]{3}-[0-9]{3}-[0-9]{4} x[0-9]{3,5}$/", $phone))
        //    throw new \Exception("Invalid phone number");

        $this->email = strtolower($this->email);

    }

    public function getEmail() : string {
        return $this->email;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getPhone() : string {
        return $this->phone;
    }

    public function getCompany() : string {
        return $this->company;
    }

}