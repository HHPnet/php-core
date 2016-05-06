<?php

namespace spec\HHPnet\Core\Application\Services\Groups\SaveGroup;

use PhpSpec\ObjectBehavior;

class SaveGroupRequestSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('name', 'country', 'bio');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Groups\SaveGroup\SaveGroupRequest');
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
