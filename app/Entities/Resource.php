<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Resource extends Entity
{
    protected $attributes = [
        'id' => null,
        'name' => null,
    ];

    protected $casts = [
        'id' => 'int',
        'name' => 'string',
    ];
}