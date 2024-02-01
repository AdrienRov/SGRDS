<?php

namespace App\Models;
use CodeIgniter\Model;
class UserResourceModel extends Model
{
    protected $table         = 'users_resources';
    protected $allowedFields = [
        'user_id', 'resource_id'
    ];
    protected $returnType    = \App\Entities\UserResource::class;
    protected $useTimestamps = true;
}