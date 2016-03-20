<?php

namespace HHPnet\Core\Domain\Users;

class User
{
    private $id;

    private $username;

    private $password;

    private $email;

    public function __construct(UserId $id, $username, $password, $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_BCRYPT, [
            'salt' => $this->id->getId(),
        ]);
        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function getId()
    {
        return $this->id->getId();
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function isValidPassword($verify_password)
    {
        return password_verify($verify_password, $this->getPassword());
    }
}
