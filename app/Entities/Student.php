<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Student extends Entity
{
    protected $attributes = [
        'id' => null,
        'first_name' => null,
        'last_name' => null,
        'email' => null,
        'promotion' => null,
    ];

    protected $casts = [
        'id' => 'int',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'promotion' => 'string',
    ];
}