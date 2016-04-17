<?php

namespace spec\HHPnet\Core\Domain\Videos;

use spec\HHPnet\Core\Domain\Shared\EntityId;

class VideoIdSpec extends EntityId
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Videos\VideoId');
    }
}
