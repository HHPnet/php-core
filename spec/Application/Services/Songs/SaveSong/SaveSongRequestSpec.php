<?php

namespace spec\HHPnet\Core\Application\Services\Songs\SaveSong;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Albums\AlbumId;

class SaveSongRequestSpec extends ObjectBehavior
{
    /**
     * @param HHPnet\Core\Domain\Albums\AlbumId $album_id
     */
    public function let(AlbumId $album_id)
    {
        $this->beConstructedWith($album_id, 'name', 'type', 'path');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Songs\SaveSong\SaveSongRequest');
    }

    public function it_is_possible_to_get_album_id()
    {
        $this->albumId()->shouldHaveType('HHPnet\Core\Domain\Albums\AlbumId');
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
