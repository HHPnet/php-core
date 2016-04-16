<?php

namespace spec\HHPnet\Core\Application\Services\Users;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use HHPnet\Core\Domain\Users\UserRepositoryInterface;
use HHPnet\Core\Domain\Users\User;
use HHPnet\Core\Application\Services\Users\NewPasswordRequest;

class NewPasswordServiceSpec extends ObjectBehavior
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
        $this->shouldHaveType('HHPnet\Core\Application\Services\Users\NewPasswordService');
    }

    /**
     * @param HHPnet\Core\Application\Services\Users\NewPasswordRequest $request
     */
    public function it_is_possible_to_generate_a_new_password(NewPasswordRequest $request)
    {
        $request->username()->willReturn('test');
        $request->email()->willReturn('e@mail.com');

        $this->user->getEmail()->willReturn('e@mail.com');
        $this->user->generateNewPassword()->willReturn($this->user);

        $this->execute($request)->shouldHaveType('HHPnet\Core\Application\Services\Users\NewPasswordResponse');
    }

    /**
     * @param HHPnet\Core\Application\Services\Users\NewPasswordRequest $request
     */
    public function it_fails_when_given_username_and_email_combination_are_invalid(NewPasswordRequest $request)
    {
        $request->username()->willReturn('test');
        $request->email()->willReturn('e@mail.com');

        $this->user->getEmail()->willReturn('non@valid.com');

        $this->shouldThrow('\InvalidArgumentException')->during('execute', array($request));
    }
}
