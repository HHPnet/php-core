<?php

namespace HHPnet\Core\Application\Services\Users;

use HHPnet\Core\Domain\Users\UserRepository;

class NewPasswordService
{
    /**
     * @var HHPnet\Core\Domain\Users\UserRepository
     */
    private $repository;

    /**
     * @param HHPnet\Core\Domain\Users\UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  NewPasswordRequest  $request
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
