<?php

namespace spec\HHPnet\Core\Domain\Songs;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Albums\AlbumId;

class SongFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Songs\SongFactory');
    }

    /**
     * @param HHPnet\Core\Domain\Albums\AlbumId $album_id
     */
    public function it_can_create_a_group_instance(AlbumId $album_id)
    {
        $this->getSongEntity('11309c60-daeb-4f25-a209-c7ccaf921b4a', $album_id, 'test', 'test', 'test')->shouldHaveType('HHPnet\Core\Domain\Songs\Song');
    }
}
