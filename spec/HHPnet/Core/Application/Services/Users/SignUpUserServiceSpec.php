<?php

namespace spec\HHPnet\Core\Application\Services\Users;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Users\UserRepository;
use HHPnet\Core\Domain\Users\UserFactory;
use HHPnet\Core\Domain\Users\User;
use HHPnet\Core\Application\Services\Users\SignUpUserRequest;

class SignUpUserServiceSpec extends ObjectBehavior
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
    public function let(UserRepository $repository, UserFactory $factory)
    {
        $this->factory = $factory;
        $this->repository = $repository;

        $this->beConstructedWith($this->repository, $this->factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Users\SignUpUserService');
    }

    /**
     * @param HHPnet\Core\Application\Services\Users\SignUpUserRequest $request
     * @param HHPnet\Core\Domain\Users\User                            $user
     */
    public function it_is_possible_to_save_a_new_user(SignUpUserRequest $request, User $user)
    {
        $request->username()->willReturn('test');
        $request->password()->willReturn('test');
        $request->email()->willReturn('test');

        $this->factory->getUserEntity(null, 'test', 'test', 'test')->willReturn($user);

        $this->repository->getByEmail('test')->willThrow('\UnexpectedValueException');
        $this->repository->save($user)->willReturn($user);

        $this->execute($request)->shouldHaveType('HHPnet\Core\Application\Services\Users\SignUpUserResponse');
    }

    /**
     * @param HHPnet\Core\Application\Services\Users\SignUpUserRequest $request
     */
    public function it_is_not_possible_to_register_a_given_user_twice(SignUpUserRequest $request)
    {
        $request->username()->willReturn('test');
        $request->password()->willReturn('test');
        $request->email()->willReturn('test');

        $this->repository->getByEmail('test')->willReturn(true);

        $this->shouldThrow('\DomainException')->during('execute', array($request));
    }
}
