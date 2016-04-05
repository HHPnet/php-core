<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core)
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Users;

use Ramsey\Uuid\Uuid;

class UserPassword
{
    /**
     * @var string
     */
    private $password;

    /**
     * @param string $password
     */
    public function __construct($password)
    {
        $this->password = (false === password_needs_rehash($password, PASSWORD_BCRYPT)) ?
                                $password
                                : $this->encodePassword($password);
    }

    private function encodePassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param  string  $verify_password
     * @return boolean
     */
    public function isValidPassword($verify_password)
    {
        return password_verify($verify_password, $this->password);
    }

    /**
     * @return string
     */
    public function generateNewPassword()
    {
        $this->password = $this->encodePassword(Uuid::uuid4()->getHex());

        return $this->password;
    }
}
