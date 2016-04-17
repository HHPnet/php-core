<?php

namespace spec\HHPnet\Core\Infrastructure\MongoDB;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use HHPnet\Core\Domain\Songs\Song;
use HHPnet\Core\Domain\Songs\SongFactory;
use HHPnet\Core\Domain\Albums\AlbumId;

class SongRepositorySpec extends ObjectBehavior
{
    private $collection;

    private $song_factory;

    /**
     * @param MongoDB\Database                     $database
     * @param MongoDB\Collection                   $collection
     * @param HHPnet\Core\Domain\Songs\SongFactory $song_factory
     */
    public function let(
        \MongoDB\Database $database,
        \MongoDB\Collection $collection,
        SongFactory $song_factory
    ) {
        $this->collection = $collection;
        $this->song_factory = $song_factory;

        $database->selectCollection(Argument::any())->willReturn($this->collection);

        $this->beConstructedWith($database, $this->song_factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Infrastructure\MongoDB\SongRepository');
    }

    /**
     * @param HHPnet\Core\Domain\Songs\Song $song
     * @param MongoDB\UpdateResult          $upsert_result
     */
    public function it_is_possible_to_save_a_song_into_database(
        Song $song,
        \MongoDB\UpdateResult $upsert_result
    ) {
        $upsert_result->getUpsertedCount()->willReturn(1);

        $this->collection->updateOne(Argument::any(), Argument::any(), Argument::any())->willReturn($upsert_result);

        $song->getIterator()->willReturn(new \ArrayIterator([
            'id' => 1,
            'album_id' => 1,
            'name' => 'test',
            'type' => 'type_test',
            'path' => 'path_test',
        ]));

        $this->save($song)->shouldBe($song);
    }

    /**
     * @param HHPnet\Core\Domain\Songs\Song $song
     * @param MongoDB\UpdateResult          $upsert_result
     */
    public function it_fails_when_was_not_possible_to_save_song(
        Song $song,
        \MongoDB\UpdateResult $upsert_result
    ) {
        $upsert_result->getUpsertedCount()->willReturn(0);

        $this->collection->updateOne(Argument::any(), Argument::any(), Argument::any())->willReturn($upsert_result);

        $song->getIterator()->willReturn(new \ArrayIterator([
            'id' => 1,
            'album_id' => 1,
            'name' => 'test',
            'type' => 'type_test',
            'path' => 'path_test',
        ]));

        $this->shouldThrow('\DomainException')->during('save', array($song));
    }

    /**
     * @param HHPnet\Core\Domain\Songs\Song $song
     * @param MongoDB\DeleteResult          $delete_result
     */
    public function it_is_possible_to_remove_given_song(
        Song $song,
        \MongoDB\DeleteResult $delete_result
    ) {
        $delete_result->getDeletedCount()->willReturn(1);

        $this->collection->deleteOne(Argument::any())->willReturn($delete_result);

        $song->getId()->willReturn(1);

        $this->remove($song)->shouldBe(true);
    }

    /**
     * @param HHPnet\Core\Domain\Songs\Song $song
     */
    public function it_can_return_an_song_by_its_id(Song $song)
    {
        $this->song_factory->getSongEntity(
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any()
        )->willReturn($song);

        $this->collection->findOne(Argument::any())->willReturn([
            '_id' => 1,
            'album_id' => 1,
            'name' => 'test',
            'type' => 'type_test',
            'path' => 'path_test',
        ]);

        $this->getById(1)->shouldHaveType('\HHPnet\Core\Domain\Songs\Song');
    }

    public function it_fails_when_song_was_not_found_in_database_by_its_id()
    {
        $this->collection->findOne(Argument::any())->willReturn(null);

        $this->shouldThrow('\UnexpectedValueException')->during('getById', [1]);
    }

    /**
     * @param HHPnet\Core\Domain\Songs\Song     $song
     * @param HHPnet\Core\Domain\Albums\AlbumId $album_id
     */
    public function it_can_return_an_song_by_its_name(Song $song, AlbumId $album_id)
    {
        $this->song_factory->getSongEntity(
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any()
        )->willReturn($song);

        $this->collection->findOne(Argument::any())->willReturn([
            '_id' => 1,
            'album_id' => 1,
            'name' => 'test',
            'type' => 'type_test',
            'path' => 'path_test',
        ]);

        $this->getBySongByName($album_id, 'youtube')->shouldHaveType('\HHPnet\Core\Domain\Songs\Song');
    }

    /**
     * @param HHPnet\Core\Domain\Albums\AlbumId $album_id
     */
    public function it_fails_when_song_was_not_found_in_database_by_its_name(AlbumId $album_id)
    {
        $this->collection->findOne(Argument::any())->willReturn(null);

        $this->shouldThrow('\UnexpectedValueException')->during('getBySongByName', [$album_id, 'test']);
    }
}
