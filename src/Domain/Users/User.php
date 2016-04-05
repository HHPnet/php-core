<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core)
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Users;

use IteratorAggregate;
use ArrayIterator;

class User implements IteratorAggregate
{
    /**
     * @var HHPnet\Core\Domain\Users\UserId
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var UserPassword
     */
    private $password;

    /**
     * @var string
     */
    private $email;

    /**
     * @param HHPnet\Core\Domain\Users\UserId $id
     * @param string                          $username
     * @param UserPassword                    $password
     * @param string                          $email
     */
    public function __construct(UserId $id, $username, UserPassword $password, $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id->getId();
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password->getPassword();
    }

    /**
     * @return string|boolean
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param  string  $verify_password
     * @return boolean
     */
    public function isValidPassword($verify_password)
    {
        return $this->password->isValidPassword($verify_password);
    }

    /**
     * @return HHPnet\Core\Domain\Users\User
     */
    public function generateNewPassword()
    {
        $this->password->generateNewPassword();

        return $this;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator([
            'id'        => $this->getId(),
            'username'  => $this->getUsername(),
            'email'     => $this->getEmail(),
            'password'  => $this->getPassword(),
        ]);
    }
}
