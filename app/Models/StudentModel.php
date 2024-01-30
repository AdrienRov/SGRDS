<?php

namespace App\Models;
use CodeIgniter\Model;
class StudentModel extends Model
{
    protected $table         = 'students';
    protected $allowedFields = [
        'firt_name', 'last_name', 'email', 'promotion'
    ];
    protected $returnType    = \App\Entities\Student::class;
    protected $useTimestamps = true;
}