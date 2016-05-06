<?php

namespace spec\HHPnet\Core\Application\Services\Users\SignUpUser;

use PhpSpec\ObjectBehavior;

class SignUpUserRequestSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('test', 'test', 'test');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Users\SignUpUser\SignUpUserRequest');
    }

    public function it_is_possible_to_get_username()
    {
        $this->username()->shouldBe('test');
    }

    public function it_is_possible_to_get_password()
    {
        $this->password()->shouldBe('test');
    }

    public function it_is_possible_to_get_email()
    {
        $this->email()->shouldBe('test');
    }
}
