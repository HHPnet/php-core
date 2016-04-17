<?php

namespace spec\HHPnet\Core\Domain\Albums;

use spec\HHPnet\Core\Domain\Shared\EntityId;

class AlbumIdSpec extends EntityId
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Albums\AlbumId');
    }
}
