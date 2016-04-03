<?php

namespace HHPnet\Core\Infrastructure\MongoDB;

use HHPnet\Core\Domain\Users\User;
use HHPnet\Core\Domain\Users\UserRepository as UserRepositoryInterface;
use HHPnet\Core\Domain\Users\UserFactory;
use MongoDB\Database;
use DomainException;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var  MongoDB\Collection
     */
    private $collection;

    /**
     * @var HHPnet\Core\Domain\Users\UserFactory
     */
    private $factory;

    /**
     * @param MongoDB\Database                     $mongo_db
     * @param HHPnet\Core\Domain\Users\UserFactory $factory
     */
    public function __construct(Database $mongo_db, UserFactory $factory)
    {
        $this->collection = $mongo_db->selectCollection('users');
        $this->factory = $factory;
    }

    /**
     * @param  HHPnet\Core\Domain\Users\User $user
     * @return boolean
     */
    public function save(User $user)
    {
        $user_data = iterator_to_array($user);
        $user_data['_id'] = $user_data['id'];
        unset($user_data['id']);

        $result = $this->collection->updateOne(['_id' => $user_data['_id']], $user_data, ['upsert' => true]);

        if (1 !== $result->getUpsertedCount()) {
            throw new DomainException('User data could not be saved into database');
        }

        return $user;
    }

    /**
     * @param  HHPnet\Core\Domain\Users\User $user
     * @return boolean
     */
    public function remove(User $user)
    {
        return 1 === $this->collection->deleteOne(['_id'  => $user->getId()])->getDeletedCount();
    }

    /**
     * @param  string                        $user_id
     * @return HHPnet\Core\Domain\Users\User
     */
    public function getById($user_id)
    {
        $user = $this->collection->findOne(['_id'   => $user_id]);

        return $this->getUserInstance($user);
    }

    /**
     * @param  string $username
     * @return User
     */
    public function getByUsername($username)
    {
        $user = $this->collection->findOne(['username'   => $username]);

        return $this->getUserInstance($user);
    }

    /**
     * @param  string                        $user_email
     * @return HHPnet\Core\Domain\Users\User
     */
    public function getByEmail($user_email)
    {
        $user = $this->collection->findOne(['email'   => $user_email]);

        return $this->getUserInstance($user);
    }

    private function getUserInstance($user_data)
    {
        if (is_null($user_data)) {
            throw new \UnexpectedValueException('User not found in database');
        }

        return $this->factory->getUserEntity(
            $user_data['_id'],
            $user_data['username'],
            $user_data['password'],
            $user_data['email']
        );
    }
}
