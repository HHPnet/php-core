<?php

namespace spec\HHPnet\Core\Application\Services\Albums;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Albums\AlbumRepositoryInterface;
use HHPnet\Core\Domain\Albums\Album;
use HHPnet\Core\Application\Services\Albums\GetAlbumRequest;

class GetAlbumServiceSpec extends ObjectBehavior
{
    /**
     * @var HHPnet\Core\Domain\Albums\AlbumRepositoryInterface
     */
    private $repository;

    /**
     * @param HHPnet\Core\Domain\Albums\AlbumRepositoryInterface $repository
     */
    public function let(AlbumRepositoryInterface $repository)
    {
        $this->repository = $repository;

        $this->beConstructedWith($this->repository);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Albums\GetAlbumService');
    }

    /**
     * @param HHPnet\Core\Application\Services\Albums\GetAlbumRequest $request
     * @param HHPnet\Core\Domain\Albums\Album                         $album
     */
    public function it_is_possible_to_get_an_existing_album(GetAlbumRequest $request, Album $album)
    {
        $request->albumId()->willReturn(1);

        $this->repository->getById(1)->willReturn($album);

        $this->execute($request)->shouldHaveType('HHPnet\Core\Application\Services\Albums\GetAlbumResponse');
    }

    /**
     * @param HHPnet\Core\Application\Services\Albums\GetAlbumRequest $request
     */
    public function it_is_not_possible_to_get_a_non_existing_album(GetAlbumRequest $request)
    {
        $request->albumId()->willReturn(1);

        $this->repository->getById(1)->willThrow('\UnexpectedValueException');

        $this->shouldThrow('\UnexpectedValueException')->during('execute', array($request));
    }
}
