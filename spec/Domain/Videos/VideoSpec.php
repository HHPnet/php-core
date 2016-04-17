<?php

namespace spec\HHPnet\Core\Domain\Videos;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Videos\VideoId;

class VideoSpec extends ObjectBehavior
{
    const VIDEO_ID = '61eb558e-53ee-477e-95aa-0836c3c1c5ff';

    /**
     * @param \HHPnet\Core\Domain\Videos\VideoId $video_id
     */
    public function let(VideoId $video_id)
    {
        $video_id->getId()->willReturn(self::VIDEO_ID);

        $this->beConstructedWith($video_id, 1, 'youtube', 'unit', 'test');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Videos\Video');
    }

    public function it_is_possible_to_get_video_id()
    {
        $this->getId()->shouldHaveType('HHPnet\Core\Domain\Videos\VideoId');
    }

    public function it_is_possible_to_get_video_service_id()
    {
        $this->getVideoServiceId()->shouldBe(1);
    }

    public function it_is_possible_to_get_video_service()
    {
        $this->getVideoService()->shouldBe('youtube');
    }

    public function it_is_possible_to_get_title()
    {
        $this->getTitle()->shouldBe('unit');
    }

    public function it_is_possible_to_get_description()
    {
        $this->getDescription()->shouldBe('test');
    }
}
