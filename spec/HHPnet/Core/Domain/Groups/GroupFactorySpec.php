<?php

namespace spec\HHPnet\Core\Domain\Groups;

use PhpSpec\ObjectBehavior;

class GroupFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Groups\GroupFactory');
    }

    public function it_can_create_a_group_instance()
    {
        $this->getGroupEntity('11309c60-daeb-4f25-a209-c7ccaf921b4a', 'test', 'test', 'test')->shouldHaveType('HHPnet\Core\Domain\Groups\Group');
    }
}
