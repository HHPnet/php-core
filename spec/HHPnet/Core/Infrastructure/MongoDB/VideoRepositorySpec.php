<?php

namespace spec\HHPnet\Core\Infrastructure\MongoDB;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VideoRepositorySpec extends ObjectBehavior
{
    private $collection;

    private $video_factory;

    /**
     * @param MongoDB\Database                     $database
     * @param MongoDB\Collection                   $collection
     * @param HHPnet\Core\Domain\Videos\VideoFactory $video_factory
     */
    public function let(
        \MongoDB\Database $database,
        \MongoDB\Collection $collection,
        \HHPnet\Core\Domain\Videos\VideoFactory $video_factory
    )
    {
        $this->collection = $collection;
        $this->video_factory = $video_factory;

        $database->selectCollection(Argument::any())->willReturn($this->collection);

        $this->beConstructedWith($database, $this->video_factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Infrastructure\MongoDB\VideoRepository');
    }

    /**
     * @param HHPnet\Core\Domain\Videos\Video $video
     * @param MongoDB\UpdateResult          $upsert_result
     */
    public function it_is_possible_to_save_a_video_into_database(
        \HHPnet\Core\Domain\Videos\Video $video,
        \MongoDB\UpdateResult $upsert_result
    )
    {
        $upsert_result->getUpsertedCount()->willReturn(1);

        $this->collection->updateOne(Argument::any(), Argument::any(), Argument::any())->willReturn($upsert_result);

        $video->getIterator()->willReturn(new \ArrayIterator([
            'id'                => 1,
            'video_service_id'  => 'test',
            'video_service'     => 'youtube',
            'title'             => 'title',
            'description'       => 'desc'
        ]));

        $this->save($video)->shouldBe($video);
    }

    /**
     * @param HHPnet\Core\Domain\Videos\Video $video
     * @param MongoDB\UpdateResult          $upsert_result
     */
    public function it_fails_when_was_not_possible_to_save_video(
        \HHPnet\Core\Domain\Videos\Video $video,
        \MongoDB\UpdateResult $upsert_result
    )
    {
        $upsert_result->getUpsertedCount()->willReturn(0);

        $this->collection->updateOne(Argument::any(), Argument::any(), Argument::any())->willReturn($upsert_result);

        $video->getIterator()->willReturn(new \ArrayIterator([
            'id'                => 1,
            'video_service_id'  => 'test',
            'video_service'     => 'youtube',
            'title'             => 'title',
            'description'       => 'desc'
        ]));

        $this->shouldThrow('\DomainException')->during('save', array($video));
    }

    /**
     * @param HHPnet\Core\Domain\Videos\Video $video
     * @param MongoDB\DeleteResult          $delete_result
     */
    public function it_is_possible_to_remove_given_video(
        \HHPnet\Core\Domain\Videos\Video $video,
        \MongoDB\DeleteResult $delete_result
    )
    {
        $delete_result->getDeletedCount()->willReturn(1);

        $this->collection->deleteOne(Argument::any())->willReturn($delete_result);

        $video->getId()->willReturn(1);

        $this->remove($video)->shouldBe(true);
    }

    /**
     * @param \HHPnet\Core\Domain\Videos\Video $video
     */
    public function it_can_return_an_video_by_its_id(\HHPnet\Core\Domain\Videos\Video $video)
    {
        $this->video_factory->getVideoEntity(
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any()
        )->willReturn($video);

        $this->collection->findOne(Argument::any())->willReturn([
            '_id'                => 1,
            'video_service_id'  => 'test',
            'video_service'     => 'youtube',
            'title'             => 'title',
            'description'       => 'desc'
        ]);

        $this->getById(1)->shouldHaveType('\HHPnet\Core\Domain\Videos\Video');
    }

    public function it_fails_when_video_was_not_found_in_database_by_its_id()
    {
       $this->collection->findOne(Argument::any())->willReturn(null);

       $this->shouldThrow('\UnexpectedValueException')->during('getById', [1]);
    }

    /**
     * @param \HHPnet\Core\Domain\Videos\Video $video
     */
    public function it_can_return_an_video_by_its_video_service_id(\HHPnet\Core\Domain\Videos\Video $video)
    {
        $this->video_factory->getVideoEntity(
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any()
        )->willReturn($video);

        $this->collection->findOne(Argument::any())->willReturn([
            '_id'                => 1,
            'video_service_id'  => 'test',
            'video_service'     => 'youtube',
            'title'             => 'title',
            'description'       => 'desc'
        ]);

        $this->getBygetVideoServiceId('test', 'youtube')->shouldHaveType('\HHPnet\Core\Domain\Videos\Video');
    }

    public function it_fails_when_video_was_not_found_in_database_by_its_video_service_id()
    {
       $this->collection->findOne(Argument::any())->willReturn(null);

       $this->shouldThrow('\UnexpectedValueException')->during('getBygetVideoServiceId', ['test', 'youtube']);
    }
}
