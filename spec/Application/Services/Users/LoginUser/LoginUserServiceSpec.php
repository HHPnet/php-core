<?php

namespace spec\HHPnet\Core\Application\Services\Users\LoginUser;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use HHPnet\Core\Domain\Users\UserRepositoryInterface;
use HHPnet\Core\Domain\Users\User;
use HHPnet\Core\Application\Services\Users\LoginUser\LoginUserRequest;

class LoginUserServiceSpec extends ObjectBehavior
{
    /**
     * @var HHPnet\Core\Domain\Users\User
     */
    private $user;

    /**
     * @param HHPnet\Core\Domain\Users\UserRepositoryInterface $repository
     * @param HHPnet\Core\Domain\Users\User                    $user
     */
    public function let(UserRepositoryInterface $repository, User $user)
    {
        $this->user = $user;

        $repository->getByUsername(Argument::any())->willReturn($this->user);

        $this->beConstructedWith($repository);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Users\LoginUser\LoginUserService');
    }

    /**
     * @param HHPnet\Core\Application\Services\Users\LoginUser\LoginUserRequest $request
     */
    public function it_is_possible_to_log_in_a_given_user(LoginUserRequest $request)
    {
        $request->username()->willReturn('test');
        $request->password()->willReturn('test');

        $this->user->isValidPassword(Argument::any())->willReturn(true);

        $this->execute($request)->shouldHaveType('HHPnet\Core\Application\Services\Users\LoginUser\LoginUserResponse');
    }

    /**
     * @param HHPnet\Core\Application\Services\Users\LoginUser\LoginUserRequest $request
     */
    public function it_fails_when_given_credentials_are_invalid(LoginUserRequest $request)
    {
        $request->username()->willReturn('test');
        $request->password()->willReturn('test');

        $this->user->isValidPassword(Argument::any())->willReturn(false);

        $this->shouldThrow('\InvalidArgumentException')->during('execute', array($request));
    }
}
