<?php

namespace spec\HHPnet\Core\Domain\Users;

use PhpSpec\ObjectBehavior;

class UserFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Users\UserFactory');
    }

    public function it_can_create_a_user_instance()
    {
        $this->getUserEntity(1, 'test', 'test', 'e@mail.com')->shouldHaveType('HHPnet\Core\Domain\Users\User');
    }
}
