<?php

namespace spec\HHPnet\Core\Application\Services\Songs;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Songs\SongRepositoryInterface;
use HHPnet\Core\Domain\Songs\Song;
use HHPnet\Core\Application\Services\Songs\GetSongRequest;

class GetSongServiceSpec extends ObjectBehavior
{
    /**
     * @var HHPnet\Core\Domain\Songs\SongRepositoryInterface
     */
    private $repository;

    /**
     * @param HHPnet\Core\Domain\Songs\SongRepositoryInterface $repository
     */
    public function let(SongRepositoryInterface $repository)
    {
        $this->repository = $repository;

        $this->beConstructedWith($this->repository);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Songs\GetSongService');
    }

    /**
     * @param HHPnet\Core\Application\Services\Songs\GetSongRequest $request
     * @param HHPnet\Core\Domain\Songs\Song                         $song
     */
    public function it_is_possible_to_get_an_existing_song(GetSongRequest $request, Song $song)
    {
        $request->songId()->willReturn(1);

        $this->repository->getById(1)->willReturn($song);

        $this->execute($request)->shouldHaveType('HHPnet\Core\Application\Services\Songs\GetSongResponse');
    }

    /**
     * @param HHPnet\Core\Application\Services\Songs\GetSongRequest $request
     */
    public function it_is_not_possible_to_get_a_non_existing_song(GetSongRequest $request)
    {
        $request->songId()->willReturn(1);

        $this->repository->getById(1)->willThrow('\UnexpectedValueException');

        $this->shouldThrow('\UnexpectedValueException')->during('execute', array($request));
    }
}
