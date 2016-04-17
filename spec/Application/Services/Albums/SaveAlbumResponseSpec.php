<?php

namespace spec\HHPnet\Core\Application\Services\Albums;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Albums\Album;
use HHPnet\Core\Domain\Groups\GroupId;

class SaveAlbumResponseSpec extends ObjectBehavior
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
        $album->getName()->willReturn('album_name');
        $album->getDescription()->willReturn('album_description');
        $album->getReleaseYear()->willReturn(2001);

        $this->beConstructedWith($album);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Albums\SaveAlbumResponse');
    }

    public function it_is_possible_to_get_id()
    {
        $this->albumId()->shouldBe('1');
    }

    public function it_is_possible_to_get_group_id()
    {
        $this->groupId()->shouldBeString();
    }

    public function it_is_possible_to_get_album_name()
    {
        $this->name()->shouldBe('album_name');
    }

    public function it_is_possible_to_get_description()
    {
        $this->description()->shouldBe('album_description');
    }

    public function it_is_possible_to_get_release_year()
    {
        $this->releaseYear()->shouldBe(2001);
    }
}
