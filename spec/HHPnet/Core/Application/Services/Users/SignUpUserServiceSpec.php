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
     * @param HHPnet\Core\Domain\Users\UserRepository $repository
     * @param HHPnet\Core\Domain\Users\UserFactory    $factory
     * @param HHPnet\Core\Domain\Users\User           $user
     */
    public function let(UserRepository $repository, UserFactory $factory, User $user)
    {
        $factory->getUserEntity(null, 'test', 'test', 'test')->willReturn($user);

        $repository->save($user)->willReturn($user);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Users\SignUpUserService');
    }

    /**
     * @param HHPnet\Core\Application\Services\Users\SignUpUserRequest $request
     */
    public function it_is_possible_to_save_a_new_user(SignUpUserRequest $request)
    {
        $request->username()->willReturn('test');
        $request->password()->willReturn('test');
        $request->email()->willReturn('test');

        $this->execute($request)->shouldHaveType('HHPnet\Core\Application\Services\Users\SignUpUserResponse');
    }
}
