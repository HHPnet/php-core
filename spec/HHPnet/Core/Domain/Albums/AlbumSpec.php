<?php

namespace spec\HHPnet\Core\Domain\Albums;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Albums\AlbumId;
use HHPnet\Core\Domain\Groups\GroupId;
use ArrayIterator;

class AlbumSpec extends ObjectBehavior
{
    const ALBUM_ID = '61eb558e-53ee-477e-95aa-0836c3c1c5ff';

    /**
     * @param \HHPnet\Core\Domain\Albums\AlbumId $album_id
     * @param HHPnet\Core\Domain\Groups\GroupId  $group_id
     */
    public function let(AlbumId $album_id, GroupId $group_id)
    {
        $album_id->getId()->willReturn(self::ALBUM_ID);
        $group_id->getId()->willReturn(self::ALBUM_ID);

        $this->beConstructedWith($album_id, $group_id, 'album', 'description', 2001);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Domain\Albums\Album');
    }

    public function it_is_possible_to_get_album_id()
    {
        $this->getId()->shouldBe(self::ALBUM_ID);
    }

    public function it_is_possible_to_get_album_group()
    {
        $this->getGroupId()->shouldHaveType('HHPnet\Core\Domain\Groups\GroupId');
    }

    public function it_is_possible_to_get_album_name()
    {
        $this->getName()->shouldBe('album');
    }

    public function it_is_possible_to_get_description()
    {
        $this->getDescription()->shouldBe('description');
    }

    public function it_is_possible_to_get_release_year()
    {
        $this->getReleaseYear()->shouldBe(2001);
    }

    public function it_is_possible_to_convert_album_to_array()
    {
        $this->getIterator()->shouldBeLike(new ArrayIterator([
            'id' => self::ALBUM_ID,
            'group_id' => self::ALBUM_ID,
            'name' => 'album',
            'description' => 'description',
            'release_year' => 2001,
        ]));
    }
}
