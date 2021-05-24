<?php

namespace App\Repository;

use App\Model\User;

interface UserRepository
{
    public function store(array $users);
}