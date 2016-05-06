<?php

namespace spec\HHPnet\Core\Application\Services\Albums\GetAlbum;

use PhpSpec\ObjectBehavior;

class GetAlbumRequestSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(1);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Albums\GetAlbum\GetAlbumRequest');
    }

    public function it_is_possible_to_get_id()
    {
        $this->albumId()->shouldBe(1);
    }
}
