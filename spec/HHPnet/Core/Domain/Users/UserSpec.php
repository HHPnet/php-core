<?php

namespace spec\HHPnet\Core\Domain\Users;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Users\UserId;

class UserSpec extends ObjectBehavior
{
    /**
     * @param \HHPnet\Core\Domain\Users\UserId $user_id
     */
    public function let(UserId $user_id)
    {
        $user_id->getId()->willReturn('61eb558e-53ee-477e-95aa-0836c3c1c5ff');

        $this->beConstructedWith($user_id, 'user', 'password', 'e@mail.com');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Users\User');
    }

    public function it_is_possible_to_get_user_id()
    {
        $this->getId()->shouldBe('61eb558e-53ee-477e-95aa-0836c3c1c5ff');
    }

    public function it_is_possible_to_get_username()
    {
        $this->getUsername()->shouldBe('user');
    }

    public function it_is_possible_to_get_password()
    {
        $this->getPassword()->shouldBeString();
    }

    public function it_is_possible_to_get_email_when_valid_provided()
    {
        $this->getEmail()->shouldBe('e@mail.com');
    }

    /**
     * @param \HHPnet\Core\Domain\Users\UserId $user_id
     */
    public function it_returns_false_when_invalid_email_provided(UserId $user_id)
    {
        $this->beConstructedWith($user_id, 'user', 'password', 'email');

        $this->getEmail()->shouldBe(false);
    }

    public function it_is_possible_to_check_if_given_password_is_valid()
    {
        $this->isValidPassword('password')->shouldBe(true);
    }

    public function it_fails_when_invalid_password_is_provided()
    {
        $this->isValidPassword('invalid_password')->shouldBe(false);
    }
}
