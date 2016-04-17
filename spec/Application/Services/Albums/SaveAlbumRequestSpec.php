<?php

namespace spec\HHPnet\Core\Application\Services\Albums;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Groups\GroupId;

class SaveAlbumRequestSpec extends ObjectBehavior
{
    /**
     * @param HHPnet\Core\Domain\Groups\GroupId $group_id
     */
    public function let(GroupId $group_id)
    {
        $this->beConstructedWith($group_id, 'name', 'description', 2001);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Albums\SaveAlbumRequest');
    }

    public function it_is_possible_to_get_group_id()
    {
        $this->groupId()->shouldHaveType('HHPnet\Core\Domain\Groups\GroupId');
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
