<?php

namespace spec\HHPnet\Core\Application\Services\Songs\SaveSong;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Songs\Song;
use HHPnet\Core\Domain\Albums\AlbumId;

class SaveSongResponseSpec extends ObjectBehavior
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
        $song->getName()->willReturn('song_name');
        $song->getType()->willReturn('song_type');
        $song->getPath()->willReturn('song_path');

        $this->beConstructedWith($song);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Songs\SaveSong\SaveSongResponse');
    }

    public function it_is_possible_to_get_id()
    {
        $this->songId()->shouldBe('1');
    }

    public function it_is_possible_to_get_album_id()
    {
        $this->albumId()->shouldBeString();
    }

    public function it_is_possible_to_get_song_name()
    {
        $this->name()->shouldBe('song_name');
    }

    public function it_is_possible_to_get_type()
    {
        $this->type()->shouldBe('song_type');
    }

    public function it_is_possible_to_get_path()
    {
        $this->path()->shouldBe('song_path');
    }
}
