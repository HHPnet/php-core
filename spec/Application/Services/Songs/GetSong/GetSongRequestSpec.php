<?php

namespace spec\HHPnet\Core\Application\Services\Songs\GetSong;

use PhpSpec\ObjectBehavior;

class GetSongRequestSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(1);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Songs\GetSong\GetSongRequest');
    }

    public function it_is_possible_to_get_id()
    {
        $this->songId()->shouldBe(1);
    }
}
