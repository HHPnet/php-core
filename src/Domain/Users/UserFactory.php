<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core)
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Users;

class UserFactory
{
    public function getUserEntity($id, $username, $password, $email)
    {
        return new User(new UserId($id), $username, new UserPassword($password), $email);
    }
}
