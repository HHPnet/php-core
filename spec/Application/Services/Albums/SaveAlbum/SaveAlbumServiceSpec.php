<?php

namespace spec\HHPnet\Core\Application\Services\Albums\SaveAlbum;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Albums\AlbumRepositoryInterface;
use HHPnet\Core\Domain\Albums\AlbumFactory;
use HHPnet\Core\Domain\Albums\Album;
use HHPnet\Core\Application\Services\Albums\SaveAlbum\SaveAlbumRequest;
use HHPnet\Core\Domain\Groups\GroupId;

class SaveAlbumServiceSpec extends ObjectBehavior
{
    /**
     * @var HHPnet\Core\Domain\Albums\AlbumRepositoryInterface
     */
    private $repository;

    /**
     * @var HHPnet\Core\Domain\Albums\AlbumFactory
     */
    private $factory;

    /**
     * @param HHPnet\Core\Domain\Albums\AlbumRepositoryInterface $repository
     * @param HHPnet\Core\Domain\Albums\AlbumFactory             $factory
     */
    public function let(AlbumRepositoryInterface $repository, AlbumFactory $factory)
    {
        $this->factory = $factory;
        $this->repository = $repository;

        $this->beConstructedWith($this->repository, $this->factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Albums\SaveAlbum\SaveAlbumService');
    }

    /**
     * @param HHPnet\Core\Application\Services\Albums\SaveAlbum\SaveAlbumRequest $request
     * @param HHPnet\Core\Domain\Albums\Album                                    $album
     * @param HHPnet\Core\Domain\Groups\GroupId                                  $group_id
     */
    public function it_is_possible_to_save_a_new_album(SaveAlbumRequest $request, Album $album, GroupId $group_id)
    {
        $request->groupId()->willReturn($group_id);
        $request->name()->willReturn('name');
        $request->description()->willReturn('description');
        $request->releaseYear()->willReturn(2001);

        $this->factory->getAlbumEntity(null, $group_id, 'name', 'description', 2001)->willReturn($album);

        $this->repository->getAlbumByName($group_id, 'name')->willThrow('\UnexpectedValueException');
        $this->repository->save($album)->willReturn($album);

        $this->execute($request)->shouldHaveType('HHPnet\Core\Application\Services\Albums\SaveAlbum\SaveAlbumResponse');
    }

    /**
     * @param HHPnet\Core\Application\Services\Albums\SaveAlbum\SaveAlbumRequest $request
     * @param HHPnet\Core\Domain\Groups\GroupId                                  $group_id
     */
    public function it_is_not_possible_to_register_a_given_album_twice(SaveAlbumRequest $request, GroupId $group_id)
    {
        $request->groupId()->willReturn($group_id);
        $request->name()->willReturn('name');
        $request->description()->willReturn('description');
        $request->releaseYear()->willReturn(2001);

        $this->factory->getAlbumEntity(null, $group_id, 'name', 'description', 2001)->willReturn(true);

        $this->shouldThrow('\DomainException')->during('execute', array($request));
    }
}
