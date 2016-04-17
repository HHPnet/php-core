<?php

namespace spec\HHPnet\Core\Domain\Users;

use spec\HHPnet\Core\Domain\Shared\EntityId;

class UserIdSpec extends EntityId
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Users\UserId');
    }
}
