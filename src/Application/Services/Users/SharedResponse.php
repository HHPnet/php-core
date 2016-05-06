<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Users;

use HHPnet\Core\Domain\Users\User;

abstract class SharedResponse
{
    protected $user;

    /**
     * @param HHPnet\Core\Domain\Users\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function userId()
    {
        return (string) $this->user->getId();
    }

    /**
     * @return string
     */
    public function username()
    {
        return $this->user->getUsername();
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->user->getEmail();
    }
}
