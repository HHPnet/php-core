<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Users\LoginUser;

use HHPnet\Core\Domain\Users\UserRepositoryInterface;

class LoginUserService
{
    /**
     * @var HHPnet\Core\Domain\Users\UserRepositoryInterface
     */
    private $repository;

    /**
     * @param HHPnet\Core\Domain\Users\UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param LoginUserRequest $request
     *
     * @return LoginUserResponse
     */
    public function execute(LoginUserRequest $request)
    {
        $user = $this->repository->getByUsername($request->username());

        if (false === $user->isValidPassword($request->password())) {
            throw new \InvalidArgumentException('Invalid password');
        }

        return new LoginUserResponse($user);
    }
}
