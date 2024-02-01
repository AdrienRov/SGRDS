<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UserResource extends Entity
{
    protected $attributes = [
        'id' => null,
        'user_id' => null,
        'resource_id' => null,
    ];

    protected $casts = [
        'id' => 'int',
        'user_id' => 'int',
        'resource_id' => 'int',
    ];
}