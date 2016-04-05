<?php

namespace spec\HHPnet\Core\Domain\Users;

use PhpSpec\ObjectBehavior;

class UserPasswordSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('password');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Users\UserPassword');
    }

    public function it_encrypts_password_when_no_encrypted_provided()
    {
        $this->getPassword()->shouldStartWith('$2y$');
    }

    public function it_set_encrypted_password_when_provided()
    {
        $enc_password = '$2y$10$NjFlYjU1OGUtNTNlZS00Nu7uAxnf49wbqgdGCxa4/YHMHK1X2I3w6';
        $this->beConstructedWith($enc_password);

        $this->getPassword()->shouldBe('$2y$10$NjFlYjU1OGUtNTNlZS00Nu7uAxnf49wbqgdGCxa4/YHMHK1X2I3w6');
    }

    public function it_validates_given_password()
    {
        $this->isValidPassword('password')->shouldBe(true);
    }

    public function it_validates_invalid_password()
    {
        $this->isValidPassword('invalid_password')->shouldBe(false);
    }

    public function it_can_generate_a_new_password()
    {
        $this->generateNewPassword()->shouldStartWith('$2y$');
    }
}
