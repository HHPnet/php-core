<?php

namespace spec\HHPnet\Core\Application\Services\Groups;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Groups\Group;

class GetGroupResponseSpec extends ObjectBehavior
{
    /**
     * @param \HHPnet\Core\Domain\Groups\Group $group
     */
    public function let(Group $group)
    {
        $group->getId()->willReturn(1);
        $group->getName()->willReturn('name');
        $group->getCountry()->willReturn('country');
        $group->getBio()->willReturn('bio');

        $this->beConstructedWith($group);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Groups\GetGroupResponse');
    }

    public function it_is_possible_to_get_id()
    {
        $this->groupId()->shouldBe('1');
    }

    public function it_is_possible_to_get_group_name()
    {
        $this->name()->shouldBe('name');
    }

    public function it_is_possible_to_get_country()
    {
        $this->country()->shouldBe('country');
    }

    public function it_is_possible_to_get_bio()
    {
        $this->bio()->shouldBe('bio');
    }
}
