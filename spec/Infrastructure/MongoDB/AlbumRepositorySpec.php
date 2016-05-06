<?php

namespace spec\HHPnet\Core\Infrastructure\MongoDB;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use HHPnet\Core\Domain\Albums\AlbumFactory;
use HHPnet\Core\Domain\Albums\Album;
use HHPnet\Core\Domain\Groups\GroupId;

class AlbumRepositorySpec extends ObjectBehavior
{
    private $collection;

    private $album_factory;

    /**
     * @param MongoDB\Database                       $database
     * @param MongoDB\Collection                     $collection
     * @param HHPnet\Core\Domain\Albums\AlbumFactory $album_factory
     */
    public function let(
        \MongoDB\Database $database,
        \MongoDB\Collection $collection,
        AlbumFactory $album_factory
    ) {
        $this->collection = $collection;
        $this->album_factory = $album_factory;

        $database->selectCollection(Argument::any())->willReturn($this->collection);

        $this->beConstructedWith($database, $this->album_factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Infrastructure\MongoDB\AlbumRepository');
    }

    /**
     * @param HHPnet\Core\Domain\Albums\Album $album
     * @param MongoDB\UpdateResult            $upsert_result
     */
    public function it_is_possible_to_save_a_album_into_database(
        Album $album,
        \MongoDB\UpdateResult $upsert_result
    ) {
        $upsert_result->getUpsertedCount()->willReturn(1);

        $this->collection->updateOne(Argument::any(), Argument::any(), Argument::any())->willReturn($upsert_result);

        $album->getIterator()->willReturn(new \ArrayIterator([
            'id' => 1,
            'group_id' => 1,
            'name' => 'name_test',
            'description' => 'description_test',
            'release_year' => 2001,
        ]));

        $this->save($album)->shouldBe($album);
    }

    /**
     * @param HHPnet\Core\Domain\Albums\Album $album
     * @param MongoDB\UpdateResult            $upsert_result
     */
    public function it_fails_when_was_not_possible_to_save_album(
        Album $album,
        \MongoDB\UpdateResult $upsert_result
    ) {
        $upsert_result->getUpsertedCount()->willReturn(0);

        $this->collection->updateOne(Argument::any(), Argument::any(), Argument::any())->willReturn($upsert_result);

        $album->getIterator()->willReturn(new \ArrayIterator([
            'id' => 1,
            'group_id' => 1,
            'name' => 'name_test',
            'description' => 'description_test',
            'release_year' => 2001,
        ]));

        $this->shouldThrow('\DomainException')->during('save', array($album));
    }

    /**
     * @param HHPnet\Core\Domain\Albums\Album $album
     * @param MongoDB\DeleteResult            $delete_result
     */
    public function it_is_possible_to_remove_given_album(
        Album $album,
        \MongoDB\DeleteResult $delete_result
    ) {
        $delete_result->getDeletedCount()->willReturn(1);

        $this->collection->deleteOne(Argument::any())->willReturn($delete_result);

        $album->getId()->willReturn(1);

        $this->remove($album)->shouldBe(true);
    }

    /**
     * @param \HHPnet\Core\Domain\Albums\Album $album
     */
    public function it_can_return_an_album_by_its_id(Album $album)
    {
        $this->album_factory->getAlbumEntity(
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any()
        )->willReturn($album);

        $this->collection->findOne(Argument::any())->willReturn([
            '_id' => 1,
            'group_id' => 1,
            'name' => 'name_test',
            'description' => 'description_test',
            'release_year' => 2001,
        ]);

        $this->getById(1)->shouldHaveType('\HHPnet\Core\Domain\Albums\Album');
    }

    public function it_fails_when_album_was_not_found_in_database_by_its_id()
    {
        $this->collection->findOne(Argument::any())->willReturn(null);

        $this->shouldThrow('\UnexpectedValueException')->during('getById', [1]);
    }

    /**
     * @param \HHPnet\Core\Domain\Albums\Album  $album
     * @param HHPnet\Core\Domain\Groups\GroupId $group_id
     */
    public function it_can_return_an_album_by_its_name(Album $album, GroupId $group_id)
    {
        $this->album_factory->getAlbumEntity(
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any()
        )->willReturn($album);

        $this->collection->findOne(Argument::any())->willReturn([
            '_id' => 1,
            'group_id' => 1,
            'name' => 'name_test',
            'description' => 'description_test',
            'release_year' => 2001,
        ]);

        $this->getAlbumByName($group_id, 'test')->shouldHaveType('\HHPnet\Core\Domain\Albums\Album');
    }

    /**
     * @param HHPnet\Core\Domain\Groups\GroupId $group_id
     */
    public function it_fails_when_album_was_not_found_in_database_by_its_name(GroupId $group_id)
    {
        $this->collection->findOne(Argument::any())->willReturn(null);

        $this->shouldThrow('\UnexpectedValueException')->during('getAlbumByName', [$group_id, 'test']);
    }

    public function it_returns_next_album_identity()
    {
        $this->nextIdentity()->shouldHaveType('\HHPnet\Core\Domain\Albums\AlbumId');
    }
}
