<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Exam extends Entity
{
    protected $attributes = [
        'id' => null,
        'student_id' => null,
        'semester_id' => null,
        'resource_id' => null,
        'note' => null,
    ];

    protected $casts = [
        'id' => 'int',
        'student_id' => 'int',
        'semester_id' => 'int',
        'resource_id' => 'int',
        'note' => 'string',
    ];
}