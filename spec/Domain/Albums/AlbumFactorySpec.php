<?php

namespace spec\HHPnet\Core\Domain\Albums;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Groups\GroupId;

class AlbumFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Albums\AlbumFactory');
    }

    /**
     * @param HHPnet\Core\Domain\Groups\GroupId $group_id
     */
    public function it_can_create_a_group_instance(GroupId $group_id)
    {
        $this->getAlbumEntity('11309c60-daeb-4f25-a209-c7ccaf921b4a', $group_id, 'test', 'test', 'test')->shouldHaveType('HHPnet\Core\Domain\Albums\Album');
    }
}
