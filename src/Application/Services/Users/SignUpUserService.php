<?php

namespace HHPnet\Core\Application\Services\Users;

use HHPnet\Core\Domain\Users\UserRepository;
use HHPnet\Core\Domain\Users\UserFactory;

class SignUpUserService
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
    public function __construct(UserRepository $repository, UserFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * @param  SignUpUserRequest  $request
     * @return SignUpUserResponse
     */
    public function execute(SignUpUserRequest $request)
    {
        $user = $this->factory->getUserEntity(null, $request->username(), $request->password(), $request->email());
        $save_user_result = $this->repository->save($user);

        return new SignUpUserResponse($save_user_result);
    }
}
