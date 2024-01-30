<?php

namespace App\Models;
use CodeIgniter\Model;
class ExamModel extends Model
{
    protected $table         = 'exams';
    protected $allowedFields = [
        'date', 'class', 'type', 'status', 'comment', 'semester_id', 'resource_id', 'original_id'
    ];
    protected $returnType    = \App\Entities\Exam::class;
    protected $useTimestamps = true;
}