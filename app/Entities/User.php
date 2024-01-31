<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $attributes = [
        'id' => null,
        'first_name' => null,
        'last_name' => null,
        'email' => null,
        'password' => null,
        'type' => null,
        'created_at' => null,
        'updated_at' => null,
    ];

    public function __construct(array $data = [])
    {
        parent::__construct();

        if (!empty($data) && is_array($data)) {
            $this->fill($data);
        }
    }

    public function getFullName()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setFirstName($value)
    {
        $this->attributes['first_name'] = $value;
        return $this;
    }

    public function setLastName($value)
    {
        $this->attributes['last_name'] = $value;
        return $this;
    }

    public function setEmail($value)
    {
        $this->attributes['email'] = $value;
        return $this;
    }

    public function setPassword($value)
    {
        $this->attributes['password'] = $value;
        return $this;
    }

    public function setType($value)
    {
        $this->attributes['type'] = $value;
        return $this;
    }

}
