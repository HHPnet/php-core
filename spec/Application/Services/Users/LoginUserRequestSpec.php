<?php

namespace spec\HHPnet\Core\Application\Services\Users;

use PhpSpec\ObjectBehavior;

class LoginUserRequestSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('username', 'password');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Users\LoginUserRequest');
    }

    public function it_is_possible_to_get_username()
    {
        $this->username()->shouldBe('username');
    }

    public function it_is_possible_to_get_password()
    {
        $this->password()->shouldBe('password');
    }
}
