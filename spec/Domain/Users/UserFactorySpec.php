<?php

namespace spec\HHPnet\Core\Domain\Users;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Users\UserId;

class UserFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Users\UserFactory');
    }

    /**
     * @param HHPnet\Core\Domain\Users\UserId $user_id
     */
    public function it_can_create_a_user_instance(UserId $user_id)
    {
        $this->getUserEntity($user_id, 'test', 'test', 'e@mail.com')->shouldHaveType('HHPnet\Core\Domain\Users\User');
    }
}
