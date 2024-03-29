<?php

namespace spec\HHPnet\Core\Application\Services\Users\SignUpUser;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Users\User;

class SignUpUserResponseSpec extends ObjectBehavior
{
    /**
     * @param \HHPnet\Core\Domain\Users\User $user
     */
    public function let(User $user)
    {
        $user->getId()->willReturn(1);
        $user->getUsername()->willReturn('test');
        $user->getEmail()->willReturn('test');

        $this->beConstructedWith($user);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Users\SignUpUser\SignUpUserResponse');
    }

    public function it_is_possible_to_get_id()
    {
        $this->userId()->shouldBe('1');
    }

    public function it_is_possible_to_get_username()
    {
        $this->username()->shouldBe('test');
    }

    public function it_is_possible_to_get_email()
    {
        $this->email()->shouldBe('test');
    }
}
