<?php

namespace spec\HHPnet\Core\Application\Services\Videos\GetVideo;

use PhpSpec\ObjectBehavior;

class GetVideoRequestSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(1);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Videos\GetVideo\GetVideoRequest');
    }

    public function it_is_possible_to_get_id()
    {
        $this->videoId()->shouldBe(1);
    }
}
