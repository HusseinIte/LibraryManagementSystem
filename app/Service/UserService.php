<?php

namespace App\Service;

use App\Models\User;

/**
 * Class UserService
 * @package App\Service
 */
class UserService
{
    /**
     * @param array $data
     * @return mixed
     */
    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
    }
}
