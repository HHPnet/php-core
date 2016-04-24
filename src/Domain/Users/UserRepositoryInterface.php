<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Users;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function save(User $user);

    /**
     * @param User $user
     *
     * @return bool
     */
    public function remove(User $user);

    /**
     * @param string $user_id
     *
     * @return User
     */
    public function getById($user_id);

    /**
     * @param string $username
     *
     * @return User
     */
    public function getByUsername($username);

    /**
     * @param string $user_email
     *
     * @return User
     */
    public function getByEmail($user_email);

    /**
     * @return UserId
     */
    public function nextIdentity();
}
