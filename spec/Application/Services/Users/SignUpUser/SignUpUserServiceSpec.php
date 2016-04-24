<?php

namespace spec\HHPnet\Core\Application\Services\Users\SignUpUser;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Users\UserRepositoryInterface;
use HHPnet\Core\Domain\Users\UserFactory;
use HHPnet\Core\Domain\Users\User;
use HHPnet\Core\Domain\Users\UserId;
use HHPnet\Core\Application\Services\Users\SignUpUser\SignUpUserRequest;

class SignUpUserServiceSpec extends ObjectBehavior
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
    public function let(UserRepositoryInterface $repository, UserFactory $factory)
    {
        $this->factory = $factory;
        $this->repository = $repository;

        $this->beConstructedWith($this->repository, $this->factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Users\SignUpUser\SignUpUserService');
    }

    /**
     * @param HHPnet\Core\Application\Services\Users\SignUpUser\SignUpUserRequest $request
     * @param HHPnet\Core\Domain\Users\User                                       $user
     * @param HHPnet\Core\Domain\Users\UserId                                     $user_id
     */
    public function it_is_possible_to_save_a_new_user(SignUpUserRequest $request, User $user, UserId $user_id)
    {
        $request->username()->willReturn('test');
        $request->password()->willReturn('test');
        $request->email()->willReturn('test');

        $this->factory->getUserEntity($user_id, 'test', 'test', 'test')->willReturn($user);

        $this->repository->getByEmail('test')->willThrow('\UnexpectedValueException');
        $this->repository->save($user)->willReturn($user);
        $this->repository->nextIdentity()->willReturn($user_id);

        $this->execute($request)->shouldHaveType('HHPnet\Core\Application\Services\Users\SignUpUser\SignUpUserResponse');
    }

    /**
     * @param HHPnet\Core\Application\Services\Users\SignUpUser\SignUpUserRequest $request
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
