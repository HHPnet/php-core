<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Users;

class UserFactory
{
    public function getUserEntity(UserId $user_id, $username, $password, $email)
    {
        return new User($user_id, $username, new UserPassword($password), $email);
    }
}
