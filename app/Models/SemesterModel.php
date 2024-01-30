<?php

namespace App\Models;
use CodeIgniter\Model;
class SemesterModel extends Model
{
    protected $table         = 'semesters';
    protected $allowedFields = [
        'annee', 'semester'
    ];
    protected $returnType    = \App\Entities\Semester::class;
    protected $useTimestamps = true;
}