<?php

namespace App\Models;
use CodeIgniter\Model;
class Semester extends Model
{
    protected $table         = 'semester';
    protected $allowedFields = [
        'username', 'email', 'password',
    ];
    protected $returnType    = \App\Entities\Semester::class;
    protected $useTimestamps = true;
}