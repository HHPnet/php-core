<?php

namespace spec\HHPnet\Core\Application\Services\Songs;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Songs\Song;
use HHPnet\Core\Domain\Albums\AlbumId;

class GetSongResponseSpec extends ObjectBehavior
{
    /**
     * @param \HHPnet\Core\Domain\Songs\Song    $song
     * @param HHPnet\Core\Domain\Albums\AlbumId $album_id
     */
    public function let(Song $song, AlbumId $album_id)
    {
        $album_id->__toString()->willReturn('1');

        $song->getId()->willReturn(1);
        $song->getAlbumId()->willReturn($album_id);
        $song->getName()->willReturn('name');
        $song->getType()->willReturn('type');
        $song->getPath()->willReturn('path');

        $this->beConstructedWith($song);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Songs\GetSongResponse');
    }

    public function it_is_possible_to_get_id()
    {
        $this->songId()->shouldBe('1');
    }

    public function it_is_possible_to_get_album_id()
    {
        $this->albumId()->shouldBe('1');
    }

    public function it_is_possible_to_get_song_name()
    {
        $this->name()->shouldBe('name');
    }

    public function it_is_possible_to_get_type()
    {
        $this->type()->shouldBe('type');
    }

    public function it_is_possible_to_get_path()
    {
        $this->path()->shouldBe('path');
    }
}
