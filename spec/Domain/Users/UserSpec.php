<?php

namespace spec\HHPnet\Core\Domain\Users;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Users\UserId;
use HHPnet\Core\Domain\Users\UserPassword;
use ArrayIterator;

class UserSpec extends ObjectBehavior
{
    const USER_ID = '61eb558e-53ee-477e-95aa-0836c3c1c5ff';

    /**
     * @param \HHPnet\Core\Domain\Users\UserId       $user_id
     * @param \HHPnet\Core\Domain\Users\UserPassword $user_password
     */
    public function let(UserId $user_id, UserPassword $user_password)
    {
        $user_id->getId()->willReturn(self::USER_ID);

        $user_password->getPassword()->willReturn('password');

        $this->beConstructedWith($user_id, 'user', $user_password, 'e@mail.com');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Users\User');
    }

    public function it_is_possible_to_get_user_id()
    {
        $this->getId()->shouldBe(self::USER_ID);
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
     * @param \HHPnet\Core\Domain\Users\UserId       $user_id
     * @param \HHPnet\Core\Domain\Users\UserPassword $user_password
     */
    public function it_returns_false_when_invalid_email_provided(UserId $user_id, UserPassword $user_password)
    {
        $this->beConstructedWith($user_id, 'user', $user_password, 'email');

        $this->getEmail()->shouldBe(false);
    }

    /**
     * @param \HHPnet\Core\Domain\Users\UserId       $user_id
     * @param \HHPnet\Core\Domain\Users\UserPassword $user_password
     */
    public function it_is_possible_to_check_if_given_password_is_valid(UserId $user_id, UserPassword $user_password)
    {
        $user_password->isValidPassword('password')->willReturn(true);

        $this->beConstructedWith($user_id, 'user', $user_password, 'email');

        $this->isValidPassword('password')->shouldBe(true);
    }

    /**
     * @param \HHPnet\Core\Domain\Users\UserId       $user_id
     * @param \HHPnet\Core\Domain\Users\UserPassword $user_password
     */
    public function it_fails_when_invalid_password_is_provided(UserId $user_id, UserPassword $user_password)
    {
        $user_password->isValidPassword('invalid_password')->willReturn(false);

        $this->beConstructedWith($user_id, 'user', $user_password, 'email');

        $this->isValidPassword('invalid_password')->shouldBe(false);
    }

    public function it_is_possible_to_convert_user_to_array()
    {
        $this->getIterator()->shouldBeLike(new ArrayIterator([
            'id'        => self::USER_ID,
            'username'  => 'user',
            'email'     => 'e@mail.com',
            'password'  => 'password',
        ]));
    }
}
