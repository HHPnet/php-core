<?php

namespace HHPnet\Core\Domain\Users;

use Ramsey\Uuid\Uuid;

class UserId
{
    private $id;

    public function __construct($id = null)
    {
        if (is_null($id) || false === Uuid::isValid($id)) {
            $id = Uuid::uuid4();
        }

        $this->id = $id;
    }

    public function getId()
    {
        return (string) $this->id;
    }
}
