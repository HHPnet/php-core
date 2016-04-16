<?php

namespace HHPnet\Core\Application\Services\Users;

use HHPnet\Core\Domain\Users\UserRepositoryInterface;
use HHPnet\Core\Domain\Users\UserFactory;

class SignUpUserService
{
    /**
     * @var HHPnet\Core\Domain\Users\UserRepositoryInterface
     */
    private $repository;

    /**
     * @var HHPnet\Core\Domain\Users\UserFactory
     */
    private $factory;

    /**
     * @param HHPnet\Core\Domain\Users\UserRepositoryInterface $repository
     * @param HHPnet\Core\Domain\Users\UserFactory             $factory
     */
    public function __construct(UserRepositoryInterface $repository, UserFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * @param SignUpUserRequest $request
     *
     * @return SignUpUserResponse
     */
    public function execute(SignUpUserRequest $request)
    {
        try {
            $this->repository->getByEmail($request->email());
            throw new \DomainException('Given email has been found in database and can not be registered');
        } catch (\UnexpectedValueException $e) {
        }

        $save_user_result = $this->repository->save(
            $this->factory->getUserEntity(null, $request->username(), $request->password(), $request->email())
        );

        return new SignUpUserResponse($save_user_result);
    }
}
