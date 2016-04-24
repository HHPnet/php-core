<?php

namespace spec\HHPnet\Core\Application\Services\Users\NewPassword;

use PhpSpec\ObjectBehavior;

class NewPasswordRequestSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('username', 'e@mail.com');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Users\NewPassword\NewPasswordRequest');
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
