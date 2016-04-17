<?php

namespace spec\HHPnet\Core\Domain\Groups;

use spec\HHPnet\Core\Domain\Shared\EntityId;

class GroupIdSpec extends EntityId
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Groups\GroupId');
    }
}
