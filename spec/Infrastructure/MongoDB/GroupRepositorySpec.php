<?php

namespace spec\HHPnet\Core\Infrastructure\MongoDB;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GroupRepositorySpec extends ObjectBehavior
{
    private $collection;

    private $group_factory;

    /**
     * @param MongoDB\Database                       $database
     * @param MongoDB\Collection                     $collection
     * @param HHPnet\Core\Domain\Groups\GroupFactory $group_factory
     */
    public function let(
        \MongoDB\Database $database,
        \MongoDB\Collection $collection,
        \HHPnet\Core\Domain\Groups\GroupFactory $group_factory
    ) {
        $this->collection = $collection;
        $this->group_factory = $group_factory;

        $database->selectCollection(Argument::any())->willReturn($this->collection);

        $this->beConstructedWith($database, $this->group_factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Infrastructure\MongoDB\GroupRepository');
    }

    /**
     * @param HHPnet\Core\Domain\Groups\Group $group
     * @param MongoDB\UpdateResult            $upsert_result
     */
    public function it_is_possible_to_save_a_group_into_database(
        \HHPnet\Core\Domain\Groups\Group $group,
        \MongoDB\UpdateResult $upsert_result
    ) {
        $upsert_result->getUpsertedCount()->willReturn(1);

        $this->collection->updateOne(Argument::any(), Argument::any(), Argument::any())->willReturn($upsert_result);

        $group->getIterator()->willReturn(new \ArrayIterator([
            'id' => 1,
            'name' => 'test',
            'country' => 'country_test',
            'bio' => 'bio_test',
        ]));

        $this->save($group)->shouldBe($group);
    }

    /**
     * @param HHPnet\Core\Domain\Groups\Group $group
     * @param MongoDB\UpdateResult            $upsert_result
     */
    public function it_fails_when_was_not_possible_to_save_group(
        \HHPnet\Core\Domain\Groups\Group $group,
        \MongoDB\UpdateResult $upsert_result
    ) {
        $upsert_result->getUpsertedCount()->willReturn(0);

        $this->collection->updateOne(Argument::any(), Argument::any(), Argument::any())->willReturn($upsert_result);

        $group->getIterator()->willReturn(new \ArrayIterator([
            'id' => 1,
            'name' => 'test',
            'country' => 'country_test',
            'bio' => 'bio_test',
        ]));

        $this->shouldThrow('\DomainException')->during('save', array($group));
    }

    /**
     * @param HHPnet\Core\Domain\Groups\Group $group
     * @param MongoDB\DeleteResult            $delete_result
     */
    public function it_is_possible_to_remove_given_group(
        \HHPnet\Core\Domain\Groups\Group $group,
        \MongoDB\DeleteResult $delete_result
    ) {
        $delete_result->getDeletedCount()->willReturn(1);

        $this->collection->deleteOne(Argument::any())->willReturn($delete_result);

        $group->getId()->willReturn(1);

        $this->remove($group)->shouldBe(true);
    }

    /**
     * @param \HHPnet\Core\Domain\Groups\Group $group
     */
    public function it_can_return_an_group_by_its_id(\HHPnet\Core\Domain\Groups\Group $group)
    {
        $this->group_factory->getGroupEntity(
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any()
        )->willReturn($group);

        $this->collection->findOne(Argument::any())->willReturn([
            '_id' => 1,
            'name' => 'test',
            'country' => 'country_test',
            'bio' => 'bio_test',
        ]);

        $this->getById(1)->shouldHaveType('\HHPnet\Core\Domain\Groups\Group');
    }

    public function it_fails_when_group_was_not_found_in_database_by_its_id()
    {
        $this->collection->findOne(Argument::any())->willReturn(null);

        $this->shouldThrow('\UnexpectedValueException')->during('getById', [1]);
    }

    /**
     * @param \HHPnet\Core\Domain\Groups\Group $group
     */
    public function it_can_return_an_group_by_its_name(\HHPnet\Core\Domain\Groups\Group $group)
    {
        $this->group_factory->getGroupEntity(
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any()
        )->willReturn($group);

        $this->collection->findOne(Argument::any())->willReturn([
            '_id' => 1,
            'name' => 'test',
            'country' => 'country_test',
            'bio' => 'bio_test',
        ]);

        $this->getByGroupByName('test', 'youtube')->shouldHaveType('\HHPnet\Core\Domain\Groups\Group');
    }

    public function it_fails_when_group_was_not_found_in_database_by_its_name()
    {
        $this->collection->findOne(Argument::any())->willReturn(null);

        $this->shouldThrow('\UnexpectedValueException')->during('getByGroupByName', ['test']);
    }

    public function it_returns_next_group_identity()
    {
        $this->nextIdentity()->shouldHaveType('\HHPnet\Core\Domain\Groups\GroupId');
    }
}
