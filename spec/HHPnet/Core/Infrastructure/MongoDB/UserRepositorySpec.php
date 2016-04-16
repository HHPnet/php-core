<?php

namespace spec\HHPnet\Core\Infrastructure\MongoDB;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserRepositorySpec extends ObjectBehavior
{
    private $collection;

    private $user_factory;

    /**
     * @param MongoDB\Database                     $database
     * @param MongoDB\Collection                   $collection
     * @param HHPnet\Core\Domain\Users\UserFactory $user_factory
     */
    public function let(
        \MongoDB\Database $database,
        \MongoDB\Collection $collection,
        \HHPnet\Core\Domain\Users\UserFactory $user_factory
    ) {
        $this->collection = $collection;
        $this->user_factory = $user_factory;

        $database->selectCollection(Argument::any())->willReturn($this->collection);

        $this->beConstructedWith($database, $this->user_factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('HHPnet\Core\Infrastructure\MongoDB\UserRepository');
    }

    /**
     * @param HHPnet\Core\Domain\Users\User $user
     * @param MongoDB\UpdateResult          $upsert_result
     */
    public function it_is_possible_to_save_a_user_into_database(
        \HHPnet\Core\Domain\Users\User $user,
        \MongoDB\UpdateResult $upsert_result
    ) {
        $upsert_result->getUpsertedCount()->willReturn(1);

        $this->collection->updateOne(Argument::any(), Argument::any(), Argument::any())->willReturn($upsert_result);

        $user->getIterator()->willReturn(new \ArrayIterator([
            'id'        => 1,
            'username'  => 'test',
            'email'     => 'e@mail.com',
            'password'  => 'encrypted',
        ]));

        $this->save($user)->shouldBe($user);
    }

    /**
     * @param HHPnet\Core\Domain\Users\User $user
     * @param MongoDB\UpdateResult          $upsert_result
     */
    public function it_fails_when_was_not_possible_to_save_user(
        \HHPnet\Core\Domain\Users\User $user,
        \MongoDB\UpdateResult $upsert_result
    ) {
        $upsert_result->getUpsertedCount()->willReturn(0);

        $this->collection->updateOne(Argument::any(), Argument::any(), Argument::any())->willReturn($upsert_result);

        $user->getIterator()->willReturn(new \ArrayIterator([
            'id'        => 1,
            'username'  => 'test',
            'email'     => 'e@mail.com',
            'password'  => 'encrypted',
        ]));

        $this->shouldThrow('\DomainException')->during('save', array($user));
    }

    /**
     * @param HHPnet\Core\Domain\Users\User $user
     * @param MongoDB\DeleteResult          $delete_result
     */
    public function it_is_possible_to_remove_given_user(
        \HHPnet\Core\Domain\Users\User $user,
        \MongoDB\DeleteResult $delete_result
    ) {
        $delete_result->getDeletedCount()->willReturn(1);

        $this->collection->deleteOne(Argument::any())->willReturn($delete_result);

        $user->getId()->willReturn(1);

        $this->remove($user)->shouldBe(true);
    }

    /**
     * @param \HHPnet\Core\Domain\Users\User $user
     */
    public function it_can_return_an_user_by_its_id(\HHPnet\Core\Domain\Users\User $user)
    {
        $this->user_factory->getUserEntity(
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any()
        )->willReturn($user);

        $this->collection->findOne(Argument::any())->willReturn([
            '_id'       => 1,
            'username'  => 'test',
            'password'  => 'test',
            'email'     => 'e@mail.com',
        ]);

        $this->getById(1)->shouldHaveType('\HHPnet\Core\Domain\Users\User');
    }

    public function it_fails_when_user_was_not_found_in_database_by_its_id()
    {
        $this->collection->findOne(Argument::any())->willReturn(null);

        $this->shouldThrow('\UnexpectedValueException')->during('getById', [1]);
    }

    /**
     * @param \HHPnet\Core\Domain\Users\User $user
     */
    public function it_can_return_an_user_by_its_username(\HHPnet\Core\Domain\Users\User $user)
    {
        $this->user_factory->getUserEntity(
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any()
        )->willReturn($user);

        $this->collection->findOne(Argument::any())->willReturn([
            '_id'       => 1,
            'username'  => 'test',
            'password'  => 'test',
            'email'     => 'e@mail.com',
        ]);

        $this->getByUsername('test')->shouldHaveType('\HHPnet\Core\Domain\Users\User');
    }

    public function it_fails_when_user_was_not_found_in_database_by_its_username()
    {
        $this->collection->findOne(Argument::any())->willReturn(null);

        $this->shouldThrow('\UnexpectedValueException')->during('getByUsername', ['test']);
    }

    /**
     * @param \HHPnet\Core\Domain\Users\User $user
     */
    public function it_can_return_an_user_by_its_email(\HHPnet\Core\Domain\Users\User $user)
    {
        $this->user_factory->getUserEntity(
            Argument::any(),
            Argument::any(),
            Argument::any(),
            Argument::any()
        )->willReturn($user);

        $this->collection->findOne(Argument::any())->willReturn([
            '_id'       => 1,
            'username'  => 'test',
            'password'  => 'test',
            'email'     => 'e@mail.com',
        ]);

        $this->getByEmail('e@mail.com')->shouldHaveType('\HHPnet\Core\Domain\Users\User');
    }

    public function it_fails_when_user_was_not_found_in_database_by_its_email()
    {
        $this->collection->findOne(Argument::any())->willReturn(null);

        $this->shouldThrow('\UnexpectedValueException')->during('getByEmail', ['e@mail.com']);
    }
}
