<?php

namespace spec\HHPnet\Core\Application\Services\Groups\GetGroup;

use PhpSpec\ObjectBehavior;

class GetGroupRequestSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(1);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Groups\GetGroup\GetGroupRequest');
    }

    public function it_is_possible_to_get_id()
    {
        $this->groupId()->shouldBe(1);
    }
}
