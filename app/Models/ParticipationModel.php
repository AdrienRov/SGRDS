<?php

namespace App\Models;
use CodeIgniter\Model;
class ParticipationModel extends Model
{
    protected $table         = 'participations';
    protected $allowedFields = [
        'status', 'exam_id', 'student_id'
    ];
    protected $returnType    = \App\Entities\Participation::class;
    protected $useTimestamps = true;
}