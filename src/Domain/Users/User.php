<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
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
    private $user_id;

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
     * @param HHPnet\Core\Domain\Users\UserId $user_id
     * @param string                          $username
     * @param UserPassword                    $password
     * @param string                          $email
     */
    public function __construct(UserId $user_id, $username, UserPassword $password, $email)
    {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->password = $password;
        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @return HHPnet\Core\Domain\Users\UserId
     */
    public function getId()
    {
        return $this->user_id->getId();
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
     * @return string|bool
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $verify_password
     *
     * @return bool
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
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
        ]);
    }
}
