<?php

namespace spec\HHPnet\Core\Domain\Songs;

use spec\HHPnet\Core\Domain\Shared\EntityId;

class SongIdSpec extends EntityId
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Songs\SongId');
    }
}
