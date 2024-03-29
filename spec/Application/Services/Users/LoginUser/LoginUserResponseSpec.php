<?php

namespace spec\HHPnet\Core\Application\Services\Users\LoginUser;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Users\User;

class LoginUserResponseSpec extends ObjectBehavior
{
    /**
     * @param \HHPnet\Core\Domain\Users\User $user
     */
    public function let(User $user)
    {
        $user->getId()->willReturn(1);
        $user->getUsername()->willReturn('username');
        $user->getEmail()->willReturn('e@mail.com');

        $this->beConstructedWith($user);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Users\LoginUser\LoginUserResponse');
    }

    public function it_is_possible_to_get_id()
    {
        $this->userId()->shouldBe('1');
    }

    public function it_is_possible_to_get_username()
    {
        $this->username()->shouldBe('username');
    }

    public function it_is_possible_to_get_email()
    {
        $this->email()->shouldBe('e@mail.com');
    }
}
