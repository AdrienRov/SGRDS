<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Semester extends Entity
{
    protected $attributes = [
        'id' => null,
        'annee' => null,
        'semester' => null,
    ];

    protected $casts = [
        'id' => 'int',
        'annee' => 'int',
        'semester' => 'int',
    ];
}