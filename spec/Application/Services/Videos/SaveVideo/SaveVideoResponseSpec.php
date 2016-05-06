<?php

namespace spec\HHPnet\Core\Application\Services\SaveVideo\Videos;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Videos\Video;

class SaveVideoResponseSpec extends ObjectBehavior
{
    /**
     * @param \HHPnet\Core\Domain\Videos\Video $video
     */
    public function let(Video $video)
    {
        $video->getId()->willReturn(1);
        $video->getVideoServiceId()->willReturn('video_service_id');
        $video->getVideoService()->willReturn('video_service');
        $video->getTitle()->willReturn('title');
        $video->getDescription()->willReturn('description');

        $this->beConstructedWith($video);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Videos\SaveVideo\SaveVideoResponse');
    }

    public function it_is_possible_to_get_id()
    {
        $this->videoId()->shouldBe('1');
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
