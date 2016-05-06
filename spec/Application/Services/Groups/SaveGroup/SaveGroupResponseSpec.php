<?php

namespace spec\HHPnet\Core\Application\Services\Groups\SaveGroup;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Groups\Group;

class SaveGroupResponseSpec extends ObjectBehavior
{
    /**
     * @param \HHPnet\Core\Domain\Groups\Group $group
     */
    public function let(Group $group)
    {
        $group->getId()->willReturn(1);
        $group->getName()->willReturn('group_name');
        $group->getCountry()->willReturn('group_country');
        $group->getBio()->willReturn('group_bio');

        $this->beConstructedWith($group);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Groups\SaveGroup\SaveGroupResponse');
    }

    public function it_is_possible_to_get_id()
    {
        $this->groupId()->shouldBe('1');
    }

    public function it_is_possible_to_get_group_name()
    {
        $this->name()->shouldBe('group_name');
    }

    public function it_is_possible_to_get_country()
    {
        $this->country()->shouldBe('group_country');
    }

    public function it_is_possible_to_get_bio()
    {
        $this->bio()->shouldBe('group_bio');
    }
}
