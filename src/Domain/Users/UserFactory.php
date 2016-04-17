<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Users;

use Ramsey\Uuid\UuidFactory;

class UserFactory
{
    public function getUserEntity($user_id, $username, $password, $email)
    {
        return new User(new UserId($user_id, new UuidFactory()), $username, new UserPassword($password), $email);
    }
}
