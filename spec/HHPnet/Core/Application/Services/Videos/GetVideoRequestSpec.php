<?php

namespace spec\HHPnet\Core\Application\Services\Videos;

use PhpSpec\ObjectBehavior;

class GetVideoRequestSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(1);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Videos\GetVideoRequest');
    }

    public function it_is_possible_to_get_id()
    {
        $this->id()->shouldBe(1);
    }
}
