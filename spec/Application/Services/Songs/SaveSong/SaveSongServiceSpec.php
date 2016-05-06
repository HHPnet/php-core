<?php

namespace spec\HHPnet\Core\Application\Services\Songs\SaveSong;

use PhpSpec\ObjectBehavior;
use HHPnet\Core\Domain\Songs\SongRepositoryInterface;
use HHPnet\Core\Domain\Songs\SongFactory;
use HHPnet\Core\Domain\Songs\Song;
use HHPnet\Core\Application\Services\Songs\SaveSong\SaveSongRequest;
use HHPnet\Core\Domain\Albums\AlbumId;

class SaveSongServiceSpec extends ObjectBehavior
{
    /**
     * @var HHPnet\Core\Domain\Songs\SongRepositoryInterface
     */
    private $repository;

    /**
     * @var HHPnet\Core\Domain\Songs\SongFactory
     */
    private $factory;

    /**
     * @param HHPnet\Core\Domain\Songs\SongRepositoryInterface $repository
     * @param HHPnet\Core\Domain\Songs\SongFactory             $factory
     */
    public function let(SongRepositoryInterface $repository, SongFactory $factory)
    {
        $this->factory = $factory;
        $this->repository = $repository;

        $this->beConstructedWith($this->repository, $this->factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Application\Services\Songs\SaveSong\SaveSongService');
    }

    /**
     * @param HHPnet\Core\Application\Services\Songs\SaveSong\SaveSongRequest $request
     * @param HHPnet\Core\Domain\Songs\Song                                   $song
     * @param HHPnet\Core\Domain\Albums\AlbumId                               $album_id
     */
    public function it_is_possible_to_save_a_new_song(SaveSongRequest $request, Song $song, AlbumId $album_id)
    {
        $request->albumId()->willReturn($album_id);
        $request->name()->willReturn('name');
        $request->type()->willReturn('type');
        $request->path()->willReturn('path');

        $this->factory->getSongEntity(null, $album_id, 'name', 'type', 'path')->willReturn($song);

        $this->repository->getBySongByName($album_id, 'name')->willThrow('\UnexpectedValueException');
        $this->repository->save($song)->willReturn($song);

        $this->execute($request)->shouldHaveType('HHPnet\Core\Application\Services\Songs\SaveSong\SaveSongResponse');
    }

    /**
     * @param HHPnet\Core\Application\Services\Songs\SaveSong\SaveSongRequest $request
     * @param HHPnet\Core\Domain\Albums\AlbumId                               $album_id
     */
    public function it_is_not_possible_to_register_a_given_song_twice(SaveSongRequest $request, AlbumId $album_id)
    {
        $request->albumId()->willReturn($album_id);
        $request->name()->willReturn('name');
        $request->type()->willReturn('type');
        $request->path()->willReturn('path');

        $this->factory->getSongEntity(null, $album_id, 'name', 'type', 'path')->willReturn(true);

        $this->shouldThrow('\DomainException')->during('execute', array($request));
    }
}
