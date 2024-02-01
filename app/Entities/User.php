<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $attributes = [
        'id' => null,
        'first_name' => null,
        'last_name' => null,
        'email' => null,
        'password' => null,
        'type' => null
    ];

    protected $casts = [
        'id' => 'int',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'type' => 'int'
    ];

    public function setPassword(string $password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    public function checkPassword(string $password)
    {
        return password_verify($password, $this->attributes['password']);
    }
}