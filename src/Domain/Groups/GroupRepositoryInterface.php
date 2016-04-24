<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Groups;

interface GroupRepositoryInterface
{
    /**
     * @param Group $group
     *
     * @return bool
     */
    public function save(Group $group);

    /**
     * @param Group $group
     *
     * @return bool
     */
    public function remove(Group $group);

    /**
     * @param string $group_id
     *
     * @return Group
     */
    public function getById($group_id);

    /**
     * @param string $name
     *
     * @return Group
     */
    public function getByGroupByName($name);

    /**
     * @return GroupId
     */
    public function nextIdentity();
}
