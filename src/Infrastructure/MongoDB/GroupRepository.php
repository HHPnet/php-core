<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Infrastructure\MongoDB;

use HHPnet\Core\Domain\Groups\GroupRepository as GroupRepositoryInterface;
use HHPnet\Core\Domain\Groups\Group;
use HHPnet\Core\Domain\Groups\GroupFactory;
use MongoDB\Database;
use DomainException;

class GroupRepository implements GroupRepositoryInterface
{
    /**
     * @var MongoDB\Collection
     */
    private $collection;

    /**
     * @var HHPnet\Core\Domain\Groups\GroupFactory
     */
    private $factory;

    /**
     * @param MongoDB\Database                       $mongo_db
     * @param HHPnet\Core\Domain\Groups\GroupFactory $factory
     */
    public function __construct(Database $mongo_db, GroupFactory $factory)
    {
        $this->collection = $mongo_db->selectCollection('groups');
        $this->factory = $factory;
    }

    /**
     * @param Group $group
     *
     * @return HHPnet\Core\Domain\Groups\Group
     */
    public function save(Group $group)
    {
        $group_data = iterator_to_array($group);
        $group_data['_id'] = $group_data['id'];
        unset($group_data['id']);

        $result = $this->collection->updateOne(['_id' => $group_data['_id']], $group_data, ['upsert' => true]);

        if (1 !== $result->getUpsertedCount()) {
            throw new DomainException('Group data could not be saved into database');
        }

        return $group;
    }

    /**
     * @param Group $group
     *
     * @return bool
     */
    public function remove(Group $group)
    {
        return 1 === $this->collection->deleteOne(['_id' => $group->getId()])->getDeletedCount();
    }

    /**
     * @param string $group_id
     *
     * @return HHPnet\Core\Domain\Groups\Group
     */
    public function getById($group_id)
    {
        $group = $this->collection->findOne(['_id' => $group_id]);

        return $this->getGroupInstance($group);
    }

    /**
     * @param string $name
     *
     * @return HHPnet\Core\Domain\Groups\Group
     */
    public function getByGroupByName($name)
    {
        $group = $this->collection->findOne(['name' => $name]);

        return $this->getGroupInstance($group);
    }

    private function getGroupInstance($group_data)
    {
        if (is_null($group_data)) {
            throw new \UnexpectedValueException('Group not found in database');
        }

        return $this->factory->getGroupEntity(
            $group_data['_id'],
            $group_data['name'],
            $group_data['country'],
            $group_data['bio']
        );
    }
}
