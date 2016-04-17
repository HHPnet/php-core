<?php

namespace spec\HHPnet\Core\Domain\Videos;

use PhpSpec\ObjectBehavior;

class VideoFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Videos\VideoFactory');
    }

    public function it_can_create_a_video_instance()
    {
        $this->getVideoEntity(1, 'video_service_id', 'video_service', 'title', 'description')
            ->shouldHaveType('HHPnet\Core\Domain\Videos\Video');
    }
}
