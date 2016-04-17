<?php

namespace spec\HHPnet\Core\Application\Services\Albums;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Albums\Album;
use HHPnet\Core\Domain\Groups\GroupId;

class GetAlbumResponseSpec extends ObjectBehavior
{
    /**
     * @param \HHPnet\Core\Domain\Albums\Album  $album
     * @param HHPnet\Core\Domain\Groups\GroupId $group_id
     */
    public function let(Album $album, GroupId $group_id)
    {
        $group_id->__toString()->willReturn('1');

        $album->getId()->willReturn(1);
        $album->getGroupId()->willReturn($group_id);
        $album->getName()->willReturn('name');
        $album->getDescription()->willReturn('description');
        $album->getReleaseYear()->willReturn(2001);

        $this->beConstructedWith($album);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Albums\GetAlbumResponse');
    }

    public function it_is_possible_to_get_id()
    {
        $this->albumId()->shouldBe('1');
    }

    public function it_is_possible_to_get_group_id()
    {
        $this->groupId()->shouldBe('1');
    }

    public function it_is_possible_to_get_album_name()
    {
        $this->name()->shouldBe('name');
    }

    public function it_is_possible_to_get_description()
    {
        $this->description()->shouldBe('description');
    }

    public function it_is_possible_to_get_release_year()
    {
        $this->releaseYear()->shouldBe(2001);
    }
}
