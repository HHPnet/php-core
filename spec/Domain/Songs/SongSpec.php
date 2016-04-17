<?php

namespace spec\HHPnet\Core\Domain\Songs;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Songs\SongId;
use HHPnet\Core\Domain\Albums\AlbumId;

class SongSpec extends ObjectBehavior
{
    const SONG_ID = '61eb558e-53ee-477e-95aa-0836c3c1c5ff';

    /**
     * @param \HHPnet\Core\Domain\Songs\SongId  $song_id
     * @param HHPnet\Core\Domain\Albums\AlbumId $album_id
     */
    public function let(SongId $song_id, AlbumId $album_id)
    {
        $song_id->getId()->willReturn(self::SONG_ID);
        $album_id->getId()->willReturn(self::SONG_ID);

        $this->beConstructedWith($song_id, $album_id, 'name', 'type', 'path');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Songs\Song');
    }

    public function it_is_possible_to_get_song_id()
    {
        $this->getId()->shouldHaveType('HHPnet\Core\Domain\Songs\SongId');
    }

    public function it_is_possible_to_get_song_album_id()
    {
        $this->getAlbumId()->shouldHaveType('HHPnet\Core\Domain\Albums\AlbumId');
    }

    public function it_is_possible_to_get_song_name()
    {
        $this->getName()->shouldBe('name');
    }

    public function it_is_possible_to_get_type()
    {
        $this->getType()->shouldBe('type');
    }

    public function it_is_possible_to_get_path()
    {
        $this->getPath()->shouldBe('path');
    }

    public function it_is_possible_to_convert_album_to_array()
    {
        $this->getIterator()->shouldHaveType('\ArrayIterator');
    }
}
