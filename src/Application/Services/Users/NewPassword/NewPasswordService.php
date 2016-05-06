<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Users\NewPassword;

use HHPnet\Core\Domain\Users\UserRepositoryInterface;

class NewPasswordService
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
     * @param NewPasswordRequest $request
     *
     * @return NewPasswordResponse
     */
    public function execute(NewPasswordRequest $request)
    {
        $user = $this->repository->getByUsername($request->username());

        if ($request->email() !== $user->getEmail()) {
            throw new \InvalidArgumentException('Invalid username and email combination');
        }

        return new NewPasswordResponse($user->generateNewPassword());
    }
}
