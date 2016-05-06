<?php

namespace spec\HHPnet\Core\Application\Services\Videos\SaveVideo;

use PhpSpec\ObjectBehavior;

class SaveVideoRequestSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('video_service_id', 'video_service', 'title', 'description');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Videos\SaveVideo\SaveVideoRequest');
    }

    public function it_is_possible_to_get_video_service_id()
    {
        $this->videoServiceId()->shouldBe('video_service_id');
    }

    public function it_is_possible_to_get_video_service()
    {
        $this->videoService()->shouldBe('video_service');
    }

    public function it_is_possible_to_get_title()
    {
        $this->title()->shouldBe('title');
    }

    public function it_is_possible_to_get_description()
    {
        $this->description()->shouldBe('description');
    }
}
