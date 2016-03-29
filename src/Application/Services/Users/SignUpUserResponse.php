<?php

namespace HHPnet\Core\Application\Services\Users;

use HHPnet\Core\Domain\Users\User;

class SignUpUserResponse
{
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
    public function id()
    {
        return $this->user->getId();
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