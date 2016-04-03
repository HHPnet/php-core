<?php

namespace HHPnet\Core\Application\Services\Users;

use HHPnet\Core\Domain\Users\UserRepository;
use HHPnet\Core\Domain\Users\UserFactory;

class LoginUserService
{
    /**
     * @var HHPnet\Core\Domain\Users\UserRepository
     */
    private $repository;

    /**
     * @var HHPnet\Core\Domain\Users\UserFactory
     */
    private $factory;

    /**
     * @param HHPnet\Core\Domain\Users\UserRepository $repository
     * @param HHPnet\Core\Domain\Users\UserFactory    $factory
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  LoginUserRequest  $request
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
